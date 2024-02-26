import api from '../../api/dataapi.tsx';
import GetCoinsService from '../../helpers/GetCoinsService.ts';


class AnalyticsService {

    constructor(
        private getCoinsService: GetCoinsService
    ){
        this.getCoinsService = new GetCoinsService();
    }

    getCoins() {
        return this.getCoinsService.getCoins();
    }
}
 export default AnalyticsService;