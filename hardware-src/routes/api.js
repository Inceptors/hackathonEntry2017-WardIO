const express = require('express');
const Router = require('express-promise-router');

const db = require('../db/index')

const router = new Router()

router.post('/',  async (req, res) => {
  const query = {
    text: 'SELECT temperature, pulse_rate, vibrations, timestamp FROM wardio ORDER BY timestamp DESC LIMIT 6',
    values: []
  }

  try {
    const queryResponse = await db.query(query)
    let payload = []
    queryResponse.rows.forEach((e)=> {
      payload.push(`{"payload":{"temperature":${e.temperature},"pulse_rate":${e.pulse_rate},"vibrations":${e.vibrations},"timestamp":${Date.parse(e.timestamp)}}}`)

    });
    res.json(payload);
  } catch(err) {
    console.log(err.stack)
  }
});

module.exports = router;
