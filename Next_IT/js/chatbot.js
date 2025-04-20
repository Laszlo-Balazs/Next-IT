// Updated chatbot.js to hide example questions after first user interaction
let OPENAI_API_KEY = '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';

const SHORT_PROMPT = `Te egy IT karriertanácsadó chatbot vagy, aki kizárólag a következő témákban ad tömör, lényegre törő válaszokat:
- Magyar informatikai képzések:
  * Egyetemi szakok (pl. mérnökinformatikus, programtervező informatikus)
  * Főiskolai képzések
  * OKJ és egyéb szakképzések
  * Bootcampek és magániskolák
  * Külföldi egyetemek IT képzései (ha kifejezetten erről kérdeznek)
- Magyar IT munkaerőpiac:
  * Fejlesztői pozíciók és szerepkörök (Frontend, Backend, DevOps stb.)
  * Álláskeresési lehetőségek Magyarországon
  * Magyar cégek és munkahelyek
  * Fizetési sávok és karrierlehetőségek
- Programozói karrier kezdése:
  * Ajánlott programozási nyelvek kezdőknek
  * Magyar nyelvű tanulási források
  * IT közösségek és események Magyarországon
  * Szakmai fejlődési lehetőségek

Ha a kérdés nem IT karrierrel vagy képzéssel kapcsolatos, csak annyit válaszolj: "Sajnos erre nem tudok válaszolni. Kérlek, kérdezz IT karrierrel vagy képzéssel kapcsolatos témában." Programkódot soha ne írj, még ha kérik se.
Alapvető kommunikacio: Köszönés, elköszönés, udvariasság. De a témák megtartása. nem eltérés. `;

const LONG_PROMPT = `Te egy IT karriertanácsadó chatbot vagy, aki kizárólag a következő témákban ad részletes válaszokat:
- Magyar informatikai képzések:
  * Egyetemi szakok (pl. mérnökinformatikus, programtervező informatikus)
  * Főiskolai képzések
  * OKJ és egyéb szakképzések
  * Bootcampek és magániskolák
  * Külföldi egyetemek IT képzései (ha kifejezetten erről kérdeznek)
- Magyar IT munkaerőpiac:
  * Fejlesztői pozíciók és szerepkörök (Frontend, Backend, DevOps stb.)
  * Álláskeresési lehetőségek Magyarországon
  * Magyar cégek és munkahelyek
  * Fizetési sávok és karrierlehetőségek
- Programozói karrier kezdése:
  * Ajánlott programozási nyelvek kezdőknek
  * Magyar nyelvű tanulási források
  * IT közösségek és események Magyarországon
  * Szakmai fejlődési lehetőségek

Ha a kérdés nem IT karrierrel vagy képzéssel kapcsolatos, csak annyit válaszolj: "Sajnos erre nem tudok válaszolni. Kérlek, kérdezz IT karrierrel vagy képzéssel kapcsolatos témában." Programkódot soha ne írj, még ha kérik se.
Alapvető kommunikacio: Köszönés, elköszönés, udvariasság. De a témák megtartása. nem eltérés. `;

const DEFAULT_LINE_LIMIT = 50;
const DETAILED_LINE_LIMIT = 100;
const DEFAULT_MAX_TOKENS = 2000;
const DETAILED_MAX_TOKENS = 4000;

let messageHistory = [];
let isFirstQuestion = true;

document.addEventListener('DOMContentLoaded', () => {
    const userInput = document.getElementById('user-input');
    const sendButton = document.getElementById('send-button');
    const exampleQuestionsDiv = document.querySelector('.example-questions');

    // Example question buttons
    const questionButtons = document.querySelectorAll('.question-button');
    questionButtons.forEach(button => {
        button.onclick = function(e) {
            e.preventDefault();
            const question = this.getAttribute('data-question');
            if (question) {
                document.getElementById('user-input').value = question;
                sendMessage();
            }
        };
    });

    // Send on Enter (no shift)
    userInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    // Send on button click
    sendButton.addEventListener('click', sendMessage);

    // Initial welcome
    addBotMessage("Szia! IT karriertanácsadó chatbot vagyok. Kérdezz bátran!");

    // Function to hide example questions
    function hideExampleQuestions() {
        if (exampleQuestionsDiv && isFirstQuestion) {
            exampleQuestionsDiv.style.opacity = '1';
            exampleQuestionsDiv.style.transition = 'opacity 0.5s ease-out';
            setTimeout(() => {
                exampleQuestionsDiv.style.opacity = '0';
                setTimeout(() => {
                    exampleQuestionsDiv.style.display = 'none';
                }, 500);
            }, 100);
            isFirstQuestion = false;
        }
    }

    // Add the hide function to both input methods
    userInput.addEventListener('input', () => {
        if (userInput.value.trim() !== '') {
            hideExampleQuestions();
        }
    });
    
    questionButtons.forEach(button => {
        button.addEventListener('click', hideExampleQuestions);
    });
});

function userRequestsDetail(text) {
    const lower = text.toLowerCase();
    return (
        lower.includes('hosszabban') ||
        lower.includes('bővebben') ||
        lower.includes('részletesen') ||
        lower.includes('hosszabb magyarázat') ||
        lower.includes('részletes magyarázat')
    );
}

async function sendMessage() {
    if (!OPENAI_API_KEY) {
        addBotMessage("Hiba: Nincs API kulcs beállítva!");
        return;
    }

    const userInput = document.getElementById('user-input');
    const message = userInput.value.trim();
    if (!message) return;

    addUserMessage(message);
    userInput.value = "";

    try {
        messageHistory.push({ role: "user", content: message });

        const isDetail = userRequestsDetail(message);
        const systemPrompt = isDetail ? LONG_PROMPT : SHORT_PROMPT;
        const maxTokens = isDetail ? DETAILED_MAX_TOKENS : DEFAULT_MAX_TOKENS;

        const response = await fetch('https://api.openai.com/v1/chat/completions', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${OPENAI_API_KEY}`
            },
            body: JSON.stringify({
                model: 'gpt-4o-mini',
                messages: [
                    { role: "system", content: systemPrompt },
                    ...messageHistory
                ],
                temperature: 0.7,
                max_tokens: maxTokens
            })
        });

        const data = await response.json();
        if (data.error) {
            throw new Error(data.error.message);
        }

        const botResponse = data.choices[0].message.content;
        messageHistory.push({ role: "assistant", content: botResponse });
        addBotMessage(botResponse, isDetail);

    } catch(err) {
        console.error("Chatbot error:", err);
        addBotMessage("Sajnos hiba történt, próbáld újra egy kicsit később!");
        messageHistory = [];
    }
}

function addUserMessage(msg) {
    const container = document.getElementById('chat-messages');
    const el = document.createElement('div');
    el.classList.add('message', 'user-message');
    el.textContent = msg;
    container.appendChild(el);
    container.scrollTop = container.scrollHeight;
}

function addBotMessage(msg, isDetail = false) {
    const container = document.getElementById('chat-messages');
    const el = document.createElement('div');
    el.classList.add('message', 'bot-message');

    // Add avatar
    const avatar = document.createElement('img');
    avatar.src = 'images/Logo.png';
    avatar.classList.add('avatar');
    el.appendChild(avatar);

    // Add message content container
    const messageContent = document.createElement('div');
    messageContent.classList.add('message-content');

    const lineLimit = isDetail ? DETAILED_LINE_LIMIT : DEFAULT_LINE_LIMIT;
    // Minimal formatting: just split on newlines, trim extra lines
    const lines = msg.replace(/\\n/g, '\n').split('\n');
    const truncated = lines.slice(0, lineLimit);

    // Combine them with <br> for minimal formatting
    const finalHtml = truncated.map(line => {
        return line.trim() ? line.trim() : '';
    }).join('<br>');

    messageContent.innerHTML = finalHtml;
    el.appendChild(messageContent);
    container.appendChild(el);
    container.scrollTop = container.scrollHeight;
}
