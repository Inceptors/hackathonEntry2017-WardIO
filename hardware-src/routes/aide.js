const express = require('express');
const Router = require('express-promise-router');

const db = require('../db/index')

const router = new Router()

router.post('/',  async (req, res) => {
  const query = {
    text: 'SELECT vibrations FROM vibrations ORDER BY id DESC LIMIT 1',
    values: []
  }

  try {
    const queryResponse = await db.query(query)
    let payload = queryResponse.rows[0].vibrations
    res.json({"payload":payload});
  } catch(err) {
    console.log(err.stack)
  }
});

module.exports = router;
