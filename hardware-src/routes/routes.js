const index = require('./index')
const esp = require('./esp')
const api = require('./api')
const aide = require('./aide')
const vibration = require('./vibration')

module.exports = (app) => {

  app.use('/', index) //root route
  app.use('/esp', esp)
  app.use('/api', api)
  app.use('/aide', aide)
  app.use('/vibration', vibration)

}
