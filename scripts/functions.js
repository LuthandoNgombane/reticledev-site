//LN - Initializes the slideshow index to start at the first slide
var slideIndex = 1;

//LN - Calls the showDivs function to display the initial slide with default class names
showDivs(slideIndex, 'mySlides', 'demodots', 'w3-black');

//LN - Defines a function to move the slideshow forward or backward by n slides
function plusDivs(n, slideClass = 'mySlides', dotClass = 'demodots', activeDotClass = 'w3-black') {
    //LN - Updates slideIndex by adding n and calls showDivs to display the new slide
    showDivs(slideIndex += n, slideClass, dotClass, activeDotClass);
}

//LN - Defines a function to jump to a specific slide by index
function currentDiv(n, slideClass = 'mySlides', dotClass = 'demodots', activeDotClass = 'w3-black') {
    //LN - Sets slideIndex to n and calls showDivs to display the specified slide
    showDivs(slideIndex = n, slideClass, dotClass, activeDotClass);
}

//LN - Defines a function to display the slide at the current slideIndex
function showDivs(n, slideClass = 'mySlides', dotClass = 'demodots', activeDotClass = 'w3-black') {
    //LN - Declares a loop variable i
    var i;
    //LN - Gets all elements with the specified slide class (slideshow images)
    var x = document.getElementsByClassName(slideClass);
    //LN - Gets all elements with the specified dot class (slideshow navigation dots)
    var dots = document.getElementsByClassName(dotClass);
    //LN - Resets slideIndex to 1 if it exceeds the number of slides (loop to start)
    if (n > x.length) { slideIndex = 1; }
    //LN - Sets slideIndex to the last slide if it goes below 1 (loop to end)
    if (n < 1) { slideIndex = x.length; }
    //LN - Loops through all slides to hide them
    for (i = 0; i < x.length; i++) {
        //LN - Sets the display style of the current slide to "none" to hide it
        x[i].style.display = "none";
    }
    //LN - Loops through all navigation dots to remove the active class
    for (i = 0; i < dots.length; i++) {
        //LN - Removes the active dot class from the current dot to deactivate it
        dots[i].className = dots[i].className.replace(` ${activeDotClass}`, "");
    }
    //LN - Displays the current slide by setting its display style to "block"
    x[slideIndex-1].style.display = "block";
    //LN - Adds the active dot class to the current dot to mark it as active
    dots[slideIndex-1].className += ` ${activeDotClass}`;
}

//LN - Defines a function to redirect the user to the account login page
function redirectToAccountLogin() {
    //LN - Sets the window location to the account login URL, triggering a redirect
    window.location.href = "/orders/accountLogin";
}

//LN - Defines a function to close the alert popup
function closePopup() {
    //LN - Gets the element with ID "alertPopup" (the popup container)
    var popup = document.getElementById('alertPopup');
    //LN - Checks if the popup element exists
    if (popup) {
        //LN - Sets the popup's display style to "none" to hide it
        popup.style.display = 'none';
    }
}

//LN - Form validation section begins
//LN - Gets the submit button element by its ID
const submitBtn = document.getElementById('submit-btn');

//LN - Defines an array of configuration objects for each form field's validation
const fieldConfigs = [
    //LN - Configuration for the name field
    {
        //LN - Specifies the ID of the name input element
        inputId: 'name',
        //LN - Specifies the ID of the name error message element
        errorId: 'name-error',
        //LN - Defines the validation function to check if the name is at least 2 characters
        validateFn: value => value.length >= 2,
        //LN - Sets the error message to display if the name is invalid
        errorMessage: 'Name must be at least 2 characters.'
    },
    //LN - Configuration for the email field
    {
        //LN - Specifies the ID of the email input element
        inputId: 'email',
        //LN - Specifies the ID of the email error message element
        errorId: 'email-error',
        //LN - Defines the validation function to check if the email matches a valid regex pattern
        validateFn: value => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value),
        //LN - Sets the error message to display if the email is invalid
        errorMessage: 'Please enter a valid email address.'
    },
    //LN - Configuration for the subject field
    {
        //LN - Specifies the ID of the subject input element
        inputId: 'subject',
        //LN - Specifies the ID of the subject error message element
        errorId: 'subject-error',
        //LN - Defines the validation function to check if the subject is at least 3 characters
        validateFn: value => value.length >= 3,
        //LN - Sets the error message to display if the subject is invalid
        errorMessage: 'Subject must be at least 3 characters.'
    },
    //LN - Configuration for the message field
    {
        //LN - Specifies the ID of the message input element
        inputId: 'message',
        //LN - Specifies the ID of the message error message element
        errorId: 'message-error',
        //LN - Defines the validation function to check if the message is at least 10 characters
        validateFn: value => value.length >= 10,
        //LN - Sets the error message to display if the message is invalid
        errorMessage: 'Message must be at least 10 characters.'
    }
];

//LN - Defines a generic function to validate a single form field
function validateField(inputElement, errorElement, validateFn, errorMessage) {
    //LN - Gets and trims the input value to remove leading/trailing whitespace
    const value = inputElement.value.trim();
    //LN - Checks if the input value is empty
    if (value.length === 0) {
        //LN - Clears the error message if the input is empty
        errorElement.textContent = '';
        //LN - Returns false as an empty input is considered invalid
        return false;
    }
    //LN - Applies the validation function to check if the input is valid
    const isValid = validateFn(value);
    //LN - Sets the error message text: empty if valid, errorMessage if invalid
    errorElement.textContent = isValid ? '' : errorMessage;
    //LN - Returns true if the input is valid, false otherwise
    return isValid;
}

//LN - Defines a function to validate all form fields and update the submit button state
function validateForm() {
    //LN - Checks if all fields are valid using their respective validateFn
    const allValid = fieldConfigs.every(config => {
        //LN - Gets the input element for the current field configuration
        const input = document.getElementById(config.inputId);
        //LN - Returns true if the input exists and its value is valid, false otherwise
        return input && config.validateFn(input.value.trim());
    });
    //LN - Enables the submit button if all fields are valid, disables it otherwise
    submitBtn.disabled = !allValid;
}

//LN - Loops through each field configuration to attach validation event listeners
fieldConfigs.forEach(config => {
    //LN - Gets the input element for the current field
    const inputElement = document.getElementById(config.inputId);
    //LN - Gets the error message element for the current field
    const errorElement = document.getElementById(config.errorId);
    //LN - Checks if both input and error elements exist
    if (inputElement && errorElement) {
        //LN - Adds an input event listener to the input element
        inputElement.addEventListener('input', () => {
            //LN - Validates the current field and updates its error message
            validateField(inputElement, errorElement, config.validateFn, config.errorMessage);
            //LN - Updates the submit button state based on all fields' validity
            validateForm();
        });
    }
});