function deleteLine(id) {
    let nodeCount = document.getElementsByClassName("email-body-line").length;
    let lines = document.getElementById("email-body-line-value");
    let e = document.getElementById("email-body-line-"+id);
    e.remove();
    // console.log('Deleting line');
    lines.value = (nodeCount-1).toString();
}

function addField(type) {
    let nodeCount = document.getElementsByClassName("email-body-line").length;
    let row = document.createElement("div");
    let col1 = document.createElement("div");
    let col2 = document.createElement("div");
    let input = document.createElement("input");
    let deleteButton = document.createElement("a");

    let emailBodyContainer = document.getElementById("email-body-container");
    let lines = document.getElementById("email-body-line-value");

    // Set attributes to elements
    row.className = "row email-body-line";
    row.id = "email-body-line-" + (nodeCount+1);
    col1.className = "col-11";
    input.className = "form-control";
    input.setAttribute("name","email-body-line-" + (nodeCount+1));
    input.type = type;
    col2.className = "col-auto";
    deleteButton.className = "btn btn-danger mb-3";
    deleteButton.id = (nodeCount+1).toString();
    deleteButton.href = "#";    
    deleteButton.onclick = (e) => deleteLine(deleteButton.id);
    deleteButton.innerHTML = "X";

    // Add elements
    col1.appendChild(input);
    col2.appendChild(deleteButton);
    row.appendChild(col1);
    row.appendChild(col2);
    emailBodyContainer.appendChild(row);
    lines.value = (nodeCount+1).toString();
}