function deleteLine(id) {
    let nodeCount = document.getElementsByClassName("email-body-line").length;
    let lines = document.getElementById("email-body-line-value");
    let e = document.getElementById("email-body-line-"+id);
    e.remove();
    console.log('Deleting line');
    lines.value = (nodeCount-1).toString();
}

function addField(type) {
    let nodeCount = document.getElementsByClassName("email-body-line").length;
    let div = document.createElement("div");
    let input = document.createElement("input");
    let deleteButton = document.createElement("a");

    let emailBodyContainer = document.getElementById("email-body-container");
    let lines = document.getElementById("email-body-line-value");

    // Set attributes to elements
    div.className = "email-body-line";
    div.id = "email-body-line-" + (nodeCount+1);
    input.className = "email-body-line-input";
    input.name = "email-body-line-" + (nodeCount+1);
    input.type = type;
    deleteButton.className = "delete-line-button";
    deleteButton.id = (nodeCount+1).toString();
    deleteButton.href = "#";    
    deleteButton.onclick = (e) => deleteLine(deleteButton.id);
    deleteButton.innerHTML = "X";

    // Add elements
    div.appendChild(input);
    div.appendChild(deleteButton);
    emailBodyContainer.appendChild(div);
    lines.value = (nodeCount+1).toString();
}