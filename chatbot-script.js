let currentState = "initial";

const chatPanel = document.getElementById('chat-panel');

window.addEventListener('load', () => {
    chatPanel.style.transform = "translateX(100%)";
    sendChatMessage("hello");
});

document.getElementById('chat-tab').addEventListener('click', () => {
    chatPanel.style.transform = chatPanel.style.transform === "translateX(100%)" ? "translateX(0)" : "translateX(100%)";
});

function sendMessage() {
    const inputField = document.getElementById('userInput');
    const message = inputField.value;
    inputField.value = '';
    processMessage(message);
}

function processMessage(message) {
    displayUserMessage(message);
    updateState(message);
    sendChatMessage(message);
}

function sendChatMessage(message) {
    const chatContainer = document.getElementById('chat-container');
    const state = currentState;
    fetch('https://ie121.brighton.domains/chat-api/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ message: message, state: state })
    })
        .then(response => response.json())
        .then(data => {
            displayBotResponse(data.response);
            clearQuickResponseButtons();
            switch (currentState) {
                case "initial":
                    addQuickResponseButtons(["Hello", "Help", "More Info"]);
                    break;
                case "asking_use":
                    addQuickResponseButtons(["Gaming", "Work", "General Use"]);
                    break;
                case "recommend_components":
                    addQuickResponseButtons(["CPU", "GPU", "RAM"]);
                    break;
                case "follow_up":
                    addQuickResponseButtons(["Yes, more info", "No, thank you"]);
                    break;
            }
        })
        .catch(error => console.error('Error:', error));
}

function clearQuickResponseButtons() {
    const existingButtons = document.querySelector('#chat-container .d-flex');
    if (existingButtons) {
        existingButtons.remove();
    }
}
function updateState(message) {
    switch (currentState) {
        case "initial":
            currentState = "asking_use";
            break;
        case "asking_use":
            currentState = "recommend_components";
            break;
        case "recommend_components":
            currentState = "follow_up";
            break;
        default:
            currentState = "initial";
            break;
    }
}

function displayUserMessage(message) {
    const chatContainer = document.getElementById('chat-container');
    const userDiv = document.createElement('div');
    userDiv.className = 'text-end';
    userDiv.textContent = message;
    chatContainer.appendChild(userDiv);
}

function displayBotResponse(message) {
    const chatContainer = document.getElementById('chat-container');
    const botDiv = document.createElement('div');
    botDiv.className = 'text-start';
    botDiv.textContent = message;
    chatContainer.appendChild(botDiv);
}

function addQuickResponseButtons(labels) {
    const chatContainer = document.getElementById('chat-container');
    const buttonContainer = document.createElement('div');
    buttonContainer.className = 'd-flex justify-content-start mt-2';

    labels.forEach(label => {
        const button = createQuickButton(label);
        buttonContainer.appendChild(button);
    });

    chatContainer.appendChild(buttonContainer);
}

function createQuickButton(label) {
    const button = document.createElement('button');
    button.className = 'btn btn-outline-primary me-2';
    button.textContent = label;
    button.onclick = function () { sendQuickMessage(label); };
    return button;
}

function sendQuickMessage(message) {
    displayUserMessage(message);
    sendChatMessage(message);
}
