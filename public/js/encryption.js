function encryptContent(content, password) {
    return CryptoJS.AES.encrypt(content, password).toString();
}

function decryptContent(encrypted_content, password) {
    const bytes = CryptoJS.AES.decrypt(encrypted_content, password);
    return bytes.toString(CryptoJS.enc.Utf8);
}

function generatePassword(length = 24) {
    const pool = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return chance.string({length: length, pool: pool})
}
