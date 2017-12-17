// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - https://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth

(function ($, Drupal, window, document, undefined) {

    // To understand behaviors, see https://drupal.org/node/756722#behaviors
    Drupal.behaviors.validateEasyBakeOrderForm = {
        attach: function(context, settings) {
            var easyBakeOrderForm,
                bakerURL,
                confirmPageURL,
                errorPageURL;

            // get the baker URL
            if (settings.ezBake) {
                if (settings.ezBake.bakerURL) {
                    bakerURL = settings.ezBake.bakerURL;
                }
                if (settings.ezBake.confirmPageURL) {
                    confirmPageURL = settings.ezBake.confirmPageURL;
                }
                if (settings.ezBake.errorPageURL) {
                    errorPageURL = settings.ezBake.errorPageURL;
                }
            }

            function displayValidationErrors(errors) {
                var existingMessageWrapper = document.getElementsByClassName("messages validate");
                if (existingMessageWrapper.length == 0) {
                    // create the Drupal message div
                    var pageTitle = document.getElementById('page-title');
                    var messageWrapperDiv = document.createElement('div');
                    var messageHeading = document.createElement('h2');
                    var messageList = document.createElement('ul');
                    var messageItem, message;
                    messageWrapperDiv.className = "messages--error messages error validate";
                    messageHeading.className = "element-invisible";
                    messageHeading.innerHTML = "Error message";
                    messageWrapperDiv.appendChild(messageHeading);

                    // populate the messages
                    if (errors.length > 1) {
                        messageList.className = "messages__list";
                        for (var i=0; i<errors.length; i++) {
                            messageItem = document.createElement('li');
                            messageItem.className = "messages__item";
                            message = document.createElement('pre');
                            message.innerHTML = errors[i].message;
                            messageItem.appendChild(message);
                            messageList.appendChild(messageItem);
                        }
                        messageWrapperDiv.appendChild(messageList);
                    }
                    else {
                        message = document.createTextNode(errors[0].message);
                        messageWrapperDiv.appendChild(message);
                    }

                    // insert the message wrapper
                    pageTitle.parentNode.insertBefore(messageWrapperDiv, pageTitle.nextSibling);
                }
            }

            function submitForm($form, event) {
                if (bakerURL) {
                    var postData = {
                        contact_name: $form.find("input[name='contact_name']").val(),
                        contact_email: $form.find("input[name='contact_email']").val(),
                        contact_phone: $form.find("input[name='phone_number']").val(),
                        site_name: $form.find("input[name='site_name']").val(),
                        agency_name: $form.find("input[name='agency_name']").val()
                    };
                    var websitePurpose = $form.find("textarea[name='website_purpose']").val();
                    if (websitePurpose) {
                        postData.website_purpose = websitePurpose;
                    }
                    var apiCallURL = bakerURL + '/order/submit';
                    $.ajax({
                        url: apiCallURL,
                        type: 'POST',
                        data: postData,
                        async: false,
                        success: function(data) {
                            if (confirmPageURL) {
                                window.location.replace(confirmPageURL);
                            }
                        },
                        error: function(xhr, status) {
                            var response = JSON.parse(xhr.response);
                            var errorMsg = "Error: ";
                            var errors;
                            errorMsg += response.error;
                            errorMsg += "\nDetails: ";
                            if (response.details) {
                                errorMsg += response.details.message;
                            }
                            errors = [{message: errorMsg}];
                            displayValidationErrors(errors);
                        }
                    });
                }
                else {
                    var errorMsg = "This form cannot be submitted at the moment. Please contact your administrator for more information.";
                    var errors = [{message: errorMsg}];
                    displayValidationErrors(errors);
                }
                event.preventDefault();
            }

            // Find if the EasyBake order form is present
            easyBakeOrderForm = $('form[name="easybake-order-form"]');
            if (easyBakeOrderForm && easyBakeOrderForm.length > 0) {
                // validate the form
                var validator = new FormValidator('easybake-order-form', [
                        {
                            name: "contact_name",
                            display: "name",
                            rules: 'required'
                        },
                        {
                            name: "contact_email",
                            display: "email",
                            rules: 'required|valid_email|callback_gov_email'
                        },
                        {
                            name: "phone_number",
                            display: "phone number",
                            rules: 'required'
                        },
                        {
                            name: "site_name",
                            display: "site name",
                            rules: 'required'
                        },
                        {
                            name: "agency_name",
                            display: "agency name",
                            rules: 'required'
                        }],
                    function(errors, event) {
                        if (errors.length > 0) {
                            // Show the errors
                            displayValidationErrors(errors);
                        }
                        else {
                            var messageWrapper = document.getElementsByClassName("messages validate");
                            if (messageWrapper.length > 0) {
                                messageWrapper[0].parentNode.removeChild(messageWrapper[0]);
                            }
                            var target = event.target || event.srcElement;
                            submitForm($(target), event);
                        }
                    }
                );

                validator.registerCallback('gov_email', function(value) {
                    // check for the ending of the email address
                    // only accept emails ending in gov.au
                    return /gov\.au$/.test(value);
                }).setMessage('gov_email', "We're sorry, the govCMS service is only available to Australian government entities so we require you to have a valid .gov.au email address. If you are part of a government entity that doesn't use .gov.au email addresses, please get in touch and we can help you.");
            }

        }
    };

})(jQuery, Drupal, this, this.document);
