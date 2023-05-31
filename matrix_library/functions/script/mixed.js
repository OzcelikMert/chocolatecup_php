/*
Matrix Library 
===================
Please connect to jquery before using!
===================
*/

/* Clear Variable */
function ClearVariable(variable, clear_type){
    variable = (typeof variable != "undefined") ? variable : "";

    switch(clear_type){
        case "normal":
            variable = strip_tags(variable);
            variable = variable.trim();
            variable = htmlspecialchars(variable);
            variable = variable.replace("'", '');
        break;
        // 2
        case "replace-no":
            variable = strip_tags(variable);
            variable = variable.trim();
            variable = htmlspecialchars(variable);
        break;
        // 3
        case "replace-space":
            variable = variable.replace(" ", '');
        break;
        // 4
        case "replace-slash":
            variable = variable.replace("/", '');
        break;
        // 5
        case "replace-percent":
            variable = variable.replace("%", '');
        break;
        // 6
        case "normal+email":
            variable = strip_tags(variable);
            variable = variable.trim();
            variable = htmlspecialchars(variable);
            variable = variable.replace("'", '');
            variable = filter_var(variable, "email");
        break;
        // 7
        case "normal+number":
            variable = strip_tags(variable);
            variable = variable.trim();
            variable = htmlspecialchars(variable);
            variable = variable.replace("'", '');
            variable = filter_var(variable, "number");
        break;
        // 8
        case "replace-quotation-mark":
            variable = variable.replace("'", '');
        break;
        // 0
        default:
            variable = "Wrong Clear Type"; 
        break;
    }

    return variable;
}
// Clear HTML Special Chars
function htmlspecialchars(variable) {
    return variable.replace('&', '&amp;').replace('"', '&quot;').replace("'", '&#039;').replace('<', '&lt;').replace('>', '&gt;');
}
// Clear Tag
function strip_tags(variable) {
    variable = variable.toString();
    return variable.replace(/<\/?[^>]+>/gi, '');
}
// Filter Variable
function filter_var(variable, filter_type) {
    var regex;
    // Check Filter Type
    switch(filter_type){
        case "email":
        regex = /([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+)/gi;
        break;
        case "number": 
        regex = /((?!(0))[0-9]+)/g;
        break;
    }
    // Check Defined
    if((match = regex.exec(variable)) != null){
        variable = match[0];
    }else{
        variable = "";
    }

    return variable;
}
/* end Clear Variable */