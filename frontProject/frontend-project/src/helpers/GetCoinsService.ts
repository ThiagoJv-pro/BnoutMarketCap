import api from '../api/dataapi.tsx';

class GetCoinsService {

    constructor(){}

    getCoins() {
        return new Promise((resolve, reject) => {
            api.get('currency')
              .then(response => response.data)
              .then(data => resolve(data))
              .catch(error => reject(data));
        });
    }
}
 export default GetCoinsService;