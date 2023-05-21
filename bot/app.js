const btnSend = document.getElementById("btn");
const chat = document.getElementById("chat");
const abrirchat = document.getElementById("botonchatbot");
const cerrarchat = document.getElementById("botonchatbot_cerrar");

const getMessage = (msg) => {
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      const response = xhr.responseText;
      const chatBody = document.querySelector(".scroller");
      const divCpu = document.createElement("div");
      divCpu.className = "asisbot visible";
      divCpu.innerHTML = response;
      const divUser = document.createElement("div");
      divUser.className = "me visible";
      divUser.textContent = msg;
      chatBody.append(divUser);
      setTimeout(() => {
        chatBody.append(divCpu);
      }, 600);
      //   console.log(divCpu);
    }
  };
  xhr.open("GET", "bot/bot/chat.php?msg=" + msg, true);
  xhr.send();
};

btnSend.addEventListener("click", (e) => {
  e.preventDefault();
  if (chat.value == "") {
  } else {
    getMessage(chat.value);
    chat.value = "";
  }
});


abrirchat.addEventListener("click", (e) => {
  e.preventDefault();
    document.getElementById("chatcontainer").style.display="block";
    setTimeout(() => {
      getMessage(chat.value="Hola");
      chat.value = "";
    }, 200);
});

cerrarchat.addEventListener("click", (e) => {
  e.preventDefault();
    document.getElementById("chatcontainer").style.display="none";
});
