const express = require('express');
const Router = require('express-promise-router');

const db = require('../db/index')

const router = new Router()

router.post('/', async (req, res) => {
  const query = {
    text: 'INSERT INTO vibrations (vibrations) VALUES ($1)',
    values: [req.body.payload.vibrations]
  }

  const select = {
    text: 'SELECT timestamp FROM vibrations ORDER BY timestamp DESC LIMIT 1',
    values: []
  }

    try {

      const queryResponseSelect = await db.query(select)

      let diff = new Date() - (new Date(queryResponseSelect.rows.length == 0 ? 0 : queryResponseSelect.rows[0].timestamp))
      if (diff >= 3000) {
        const queryResponse = await db.query(query)
      }

      res.send("OK");
    } catch(err) {
      console.log(err.stack)
    }


});

module.exports = router;
