import api from '../../api/dataapi.tsx';

class ListService {

    constructor(){}

    getList(typeCurrency: string) {
        return new Promise((resolve, reject) => {
            api.get('/listCoin', {
                params: {
                    currency: typeCurrency
                }
            }).then((response) => {
                resolve(response.data);
            }).catch((err) => reject(response.data));
        }
    )
    }
}

export default ListService;