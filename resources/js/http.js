import axios from 'axios';
import authHeader from './services/auth-header';

let domain = 'agregator.lan';

let myAxios = axios.create({
    baseURL: 'http://' + domain + '/api',
    headers: authHeader()
});


let self = this;

/* myAxios.interceptors.response.use(function (response) {
    if (response.status == 200 && response.data && response.data.message && response.data.message.length > 0) {
        Swal.fire({
            type: 'success',
            icon: 'success',
            text: response.data.message
        });
    }

    return response;
}, async function (error) {
    if (error.response) {
        let response = error.response;
        const code = response.status;
        const errorMessage = response.data.message;
        const originalConfig = error.config;

        if(response.data.message) {
            Swal.fire({
                type: 'error',
                message: response.data.message
            });
        }

    }
    return Promise.reject(error);
}); */


export default myAxios;
