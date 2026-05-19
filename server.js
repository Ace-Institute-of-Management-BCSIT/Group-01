const express = require('express');
const path = require('path');
const app = express();
const PORT = 3000;

// Middleware
app.use(express.urlencoded({ extended: true }));
app.use(express.static(__dirname));

// Simple user storage (in production, use proper authentication)
const users = {
    'admin': 'password123',
    'user': 'pass123'
};

// Routes
app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'login.html'));
});

app.get('/calculator', (req, res) => {
    res.sendFile(path.join(__dirname, 'index.html'));
});

app.post('/login', (req, res) => {
    const { username, password } = req.body;
    
    if (users[username] && users[username] === password) {
        res.sendFile(path.join(__dirname, 'index.html'));
    } else {
        res.send('<h3>Invalid credentials! <a href="/">Try again</a></h3>');
    }
});

app.get('/logout', (req, res) => {
    res.sendFile(path.join(__dirname, 'login.html'));
});

app.listen(PORT, () => {
    console.log(`Server running at http://localhost:${PORT}`);
});