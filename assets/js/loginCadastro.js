// Controla a transição da página de Login para Cadastro, selicionando-os pela class
const showAndHiddenSignup = (show) => {
    const loginText = document.querySelector(".slide-titulo .login");
    const loginForm = document.querySelector("form.login");
 
    // Movimenta a seção do Login e Cadastro
    if (show) {
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
    } else {
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
    }
};
 
// Determina signup como "true" e login como "false", desta forma, se o elemento clicado for o signup, ele vai acionar o showAndHiddenSignup(true) e direcionar o usuário para cadastro.
const handlerTab = (element, event) => {
    if (event.srcElement.id === "signup") showAndHiddenSignup(true);
 
    if (event.srcElement.id === "login") showAndHiddenSignup(false);
};
 
const signupLink = document.querySelector("form .contato a");
const signupBtn = document.querySelector("label.signup");
 
signupLink.onclick = () => {
    signupBtn.click();
    return false;
};
 