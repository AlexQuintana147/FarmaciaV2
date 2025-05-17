document.addEventListener('DOMContentLoaded', function() {
    const chatbox = document.getElementById('chatbot-chatbox');
    const chatbotBody = document.getElementById('chatbot-chatbox-body');
    const chatbotInput = document.getElementById('chatbot-input');
    const chatbotSendBtn = document.getElementById('chatbot-send-btn');
    const chatbotCloseBtn = document.getElementById('chatbot-chatbox-close');

    // Función para mostrar el indicador de escritura
    function showTypingIndicator() {
        const typingIndicator = document.createElement('div');
        typingIndicator.className = 'typing-indicator active';
        typingIndicator.innerHTML = '<span></span><span></span><span></span>';
        chatbotBody.appendChild(typingIndicator);
        chatbotBody.scrollTop = chatbotBody.scrollHeight;
        return typingIndicator;
    }

    // Función para ocultar el indicador de escritura
    function hideTypingIndicator(indicator) {
        if (indicator && indicator.parentNode) {
            indicator.parentNode.removeChild(indicator);
        }
    }

    // Función para agregar un mensaje al chat
    function addMessage(message, isUser = false) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `chatbot-message ${isUser ? 'user' : 'bot'}`;
        messageDiv.innerHTML = `<div class="chatbot-bubble-text">${message}</div>`;
        chatbotBody.appendChild(messageDiv);
        chatbotBody.scrollTop = chatbotBody.scrollHeight;
    }

    // Función para registrar la conversación en la base de datos
    async function logConversation(pregunta, respuesta) {
        try {
            await fetch('/chatbot/logs', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    pregunta: pregunta,
                    respuesta: respuesta
                })
            });
        } catch (error) {
            console.error('Error al registrar la conversación:', error);
        }
    }

    // Función para enviar mensaje al servidor
    async function sendMessage(message) {
        const typingIndicator = showTypingIndicator();
        try {
            const response = await fetch('/chatbot/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ message: message })
            });

            const data = await response.json();
            hideTypingIndicator(typingIndicator);
            
            if (data.success) {
                addMessage(data.message);
                // Registrar la conversación exitosa
                await logConversation(message, data.message);
            } else {
                const errorMessage = data.message || 'Lo siento, ocurrió un error al procesar tu mensaje.';
                addMessage(errorMessage);
            }
        } catch (error) {
            console.error('Error:', error);
            hideTypingIndicator(typingIndicator);
            addMessage('Lo siento, ocurrió un error al procesar tu mensaje.');
        }
    }

    // Event listener para el botón de enviar
    chatbotSendBtn.addEventListener('click', function() {
        const message = chatbotInput.value.trim();
        if (message) {
            addMessage(message, true);
            sendMessage(message);
            chatbotInput.value = '';
        }
    });

    // Event listener para la tecla Enter
    chatbotInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            const message = chatbotInput.value.trim();
            if (message) {
                addMessage(message, true);
                sendMessage(message);
                chatbotInput.value = '';
            }
        }
    });

    // Event listener para cerrar el chatbot
    chatbotCloseBtn.addEventListener('click', function() {
        chatbox.classList.add('closing');
        setTimeout(() => {
            chatbox.classList.remove('open', 'closing');
        }, 220);
    });
});