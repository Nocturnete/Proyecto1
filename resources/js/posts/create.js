import Validator from '../validator'


const form = document.getElementById("create-post-form")

if (form) {
   form.addEventListener("submit", function( event ) {
        // Reset error messages
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
        };

        // Create validation
        let validation = new Validator(data,rules)

        // Validate fields
        if (validation.passes()) {
            console.log("Validation OK")

        } else {
            let errors = validation.errors.all()
            
            for(let inputName in errors) {          
                let error = errors[inputName]
                console.log("[ERROR] " + error);
                document.getElementById(`${inputName}-error`).textContent = error;
            }

            event.preventDefault()
            return false
        }
    })
}