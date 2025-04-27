const express = require('express');
const cors = require('cors');
const fetch = require('node-fetch');
const app = express();

app.use(cors());
app.use(express.json());

app.post('/api/chat', async (req, res) => {
    try {
        const response = await fetch('https://api.openai.com/v1/chat/completions', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${req.headers.authorization.split(' ')[1]}`
            },
            body: JSON.stringify({
                ...req.body,
                model: "gpt-4"
            })
        });

        const data = await response.json();
        res.json(data);
    } catch (error) {
        console.error('Proxy hiba:', error);
        res.status(500).json({ error: error.message });
    }
});

const PORT = 3001;
app.listen(PORT, () => {
    console.log(`Proxy szerver fut: http://localhost:${PORT}`);
});
