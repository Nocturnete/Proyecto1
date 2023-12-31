import Validator from '../validator';


const form = document.getElementById("create-place-form");

if (form) {
    form.addEventListener("submit", function (event) {
        // Reset error messages
        document.getElementById("title-error").innerText = "";
        document.getElementById("latitude-error").innerText = "";
        document.getElementById("longitude-error").innerText = "";
        document.getElementById("descripcion-error").innerText = "";
        document.getElementById("visibility_id-error").innerText = "";
        document.getElementById("upload-error").innerText = "";

        // Get form inputs values
        let data = {
            "title": document.getElementById("title").value,
            "latitude": document.getElementById("latitude").value,
            "longitude": document.getElementById("longitude").value,
            "descripcion": document.getElementById("descripcion").value,
            "visibility_id": document.getElementById("visibility_id").value,
            "upload": document.getElementById("upload").value,
        };

        let rules = {
            "title": "required",
            "latitude": "required|numeric",
            "longitude": "required|numeric",
            "descripcion": "required",
            "visibility_id": "required",
            "upload": "required",
        };

        // Create validation
        let validation = new Validator(data, rules);

        // Validate fields
        if (validation.passes()) {
            console.log("Validation OK");

        } else {
            let errors = validation.errors.all();
            
            for (let inputName in errors) {
                let error = errors[inputName];
                console.log("[ERROR] " + error);
                document.getElementById(inputName + "-error").innerText = error;
            }

            event.preventDefault();
            return false;
        }
    });
}