import GetCoinsService from '../../helpers/GetCoinsService.ts';

class NavBarService {
    constructor (
        private getCoinsService: GetCoinsService
    ){
        this.getCoinsService = new GetCoinsService();
    }

    async getFavoriteCoins(): Promise<any[]> {
        const favoriteCoins = ['MKR', 'ETH', 'XMR'];
        try {
            const allCoins = await this.getCoinsService.getCoins();
            const favoritesList = allCoins.filter((coin) => favoriteCoins.includes(coin.symbol));
            return favoritesList;
        } catch (error) {
            throw error; 
        }
    }
}

export default NavBarService;