// Load our customized validationjs library
import Validator from '../validator'


// Submit form ONLY when validation is OK
const form = document.getElementById("validate-post-form")


if (form) {
   form.addEventListener("submit", function( event ) {
       // Reset errors messages
       // [...]
       document.getElementById("title-error").innerText = "";
       document.getElementById("description-error").innerText = "";
       document.getElementById("upload-error").innerText = "";
       // Get form inputs values
       let data = {
        "title": document.getElementsByName("title")[0].value,
        "description": document.getElementsByName("description")[0].value,
        "upload": document.getElementsByName("upload")[0].value,
        };
       let rules = {
            "title": "required",
            "description": "required",
            "upload": "required",
       }
       // Create validation
       let validation = new Validator(data,rules)
       // Validate fields
       if (validation.passes()) {
           // Allow submit form (do nothing)
           console.log("Validation OK")
       } else {
           // Get error messages
           let errors = validation.errors.all()
           console.log(errors)
           // Show error messages
           for(let inputName in errors) {          
               let error = errors[inputName]
               document.getElementById(`${inputName}-error`).textContent = error;
               // [...]
           }
           // Avoid submit
           event.preventDefault()
           return false
       }
   })
}
