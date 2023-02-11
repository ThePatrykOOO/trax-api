// Mock endpoints to be changed with actual REST API implementation
let traxAPI = {
  getCarsEndpoint() {
    return '/api/v1/cars'
  },
  getCarEndpoint(id) {
    return '/api/v1/cars' + '/' + id;
  },
  addCarEndpoint() {
    return '/api/v1/cars';
  },
  deleteCarEndpoint(id) {
    return '/api/v1/cars' + '/' + id;
  },
  getTripsEndpoint() {
    return '/api/v1/trips';
  },
  addTripEndpoint() {
    return 'api/v1/trips'
  }
}

export {traxAPI};
