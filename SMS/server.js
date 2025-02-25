require('dotenv').config(); // Load environment variables from .env file
const express = require('express');
const bodyParser = require('body-parser');
const twilio = require('twilio');

const app = express();
const port = process.env.PORT || 3000;

const accountSid = process.env.ACCOUNT_SID; // Twilio Account SID
const authToken = process.env.AUTH_TOKEN; // Twilio Auth Token
const fromPhoneNumber = process.env.FROM_PHONE_NUMBER; // Twilio Phone Number

const client = twilio(accountSid, authToken);

app.use(bodyParser.urlencoded({ extended: false }));

app.post('/send-sms', (req, res) => {
  const { to, body } = req.body;

  client.messages.create({
    body: body,
    to: to,
    from: fromPhoneNumber // Use the phone number from .env
  })
  .then(() => {
    res.send('SMS sent successfully!');
  })
  .catch((err) => {
    console.error(err);
    res.status(500).send('Error sending SMS');
  });
});

app.listen(port, () => {
  console.log(`Server listening on port ${port}`);
});
