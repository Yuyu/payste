import './chance.js';
import CryptoJS from './crypto-js/crypto-js.js';

export function encryptContent(content, password) {
    return CryptoJS.AES.encrypt(content, password).toString();
};

export function decryptContent(encrypted_content, password) {
    const bytes = CryptoJS.AES.decrypt(encrypted_content, password);
    return bytes.toString(CryptoJS.enc.Utf8);
};

export function generatePassword(length = 24) {
    const pool = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return chance.string({length: length, pool: pool})
};
