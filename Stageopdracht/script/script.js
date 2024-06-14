document.addEventListener("DOMContentLoaded", function() {
const form = document.getElementById("surveyForm");
form.addEventListener("submit", function(e) {
    e.preventDefault();
    const formData = new FormData(form);
    const data = {
        name: formData.get("name"),
        age: formData.get("age"),
        gender: formData.get("gender"),
        lang: formData.get("lang"),
        comments: formData.get("comments")
    };
    fetch("survey.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.status === "success") {
            const resultHtml = `
                <h3>Survey Results</h3>
                <p><strong>Name:</strong> ${data.name}</p>
                <p><strong>Age:</strong> ${data.age}</p>
                <p><strong>Gender:</strong> ${data.gender}</p>
                <p><strong>Favorite Programming Language:</strong> ${data.lang}</p>
                <p><strong>Comments:</strong> ${data.comments}</p>
            `;
            document.getElementById("surveyResult").innerHTML = resultHtml;
            document.getElementById("surveyResult").style.display = "block";
            form.reset();
        } else {
            alert("Error: " + result.message);
        }
    })
    .catch(error => {
        alert("An error occurred while submitting your survey: " + error);
        console.error("Error:", error);
    });
});
form.addEventListener("reset", function() {
    document.getElementById("surveyResult").style.display = "inline-block";
});
})

