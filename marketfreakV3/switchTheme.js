function changeTheme() {
    let bod = document.body
    let check = document.getElementById("toggle")
    let state = check.checked
    if(state) {
        bod.className = "dark-mode"
        document.cookie = "theme=dark"
    } else {
        bod.className = "light-mode"
        document.cookie = "theme=light"
    }
}