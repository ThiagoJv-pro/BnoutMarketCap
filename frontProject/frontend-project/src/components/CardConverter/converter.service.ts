import api from '../../api/dataapi.tsx';
import GetCoinsService from '../../helpers/GetCoinsService.ts';

class ConverterService {
    constructor(
        private getCoinsService: GetCoinsService
    ){
        this.getCoinsService = new GetCoinsService();
    }

    getCoins() {
        return this.getCoinsService.getCoins();
    }

    converterCurrency(from: string, to: string, inverter: boolean) {
        return new Promise((resolve, reject) => {
            api.get('/converter', {
                params: {
                  fromPrice: from,
                  toPrice: to,
                  inverter: inverter
                }}).then(response => 
                    response.data
                ).then(data => 
                    resolve(data)
                ).catch(error => reject(error));
        });
    }
}

export default ConverterService;