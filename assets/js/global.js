function $(id) {
    if(id.startsWith(".")) {
        return document.getElementsByClassName(id.substring(1));
    }else {
        return document.getElementById(id);
    }
}

document.addEventListener("click", function(event) {
    var isClickInside = $('navPfpBtn').contains(event.target);
    var isClickInsideItems = $('navPfpDropdown').contains(event.target);
    
    if($("navPfpDropdown").style.display == "none" || $("navPfpDropdown").style.display == ""  || isClickInsideItems) {
        $('navPfpDropdown').style.display = "block";
    }else {
        $("navPfpDropdown").style.display = "none";
    }
    if (!isClickInside && !isClickInsideItems) {
        //the click was outside the nav dropdown
        $("navPfpDropdown").style.display = "none";
    }
});