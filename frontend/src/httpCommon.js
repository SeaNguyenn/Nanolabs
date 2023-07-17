import axios from 'axios';
const token = JSON.parse(localStorage.getItem('token'));

if (token) {
  axios.defaults.headers.common['Authorization'] = `Bearer ${token['token']}`;
  axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
  axios.defaults.headers.common['Content-Type'] = 'application/json';
}


const instance = axios.create({
  baseURL: import.meta.env.VITE_API_BASE_URL,
  withCredentials: true,
});

export default instance;