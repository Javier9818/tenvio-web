import {helpers} from 'vuelidate/lib/validators'

export const text = helpers.regex('alpha', /^[a-zA-Z0-9À-ÿ.\u00f1\u00d1\s]*$/)
export const palabra = helpers.regex('custom', /^[a-zA-ZÀ-ÿ]*$/)
export const oracion = helpers.regex('alpha', /^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]*$/)
export const nombreText = helpers.regex('alpha', /^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]*$/)

export const nombreProducto = helpers.regex('alpha', /^[a-zA-Z0-9À-ÿ\+\-\/\u00f1\u00d1\s]*$/)
export const nombreProductoDescripcion = helpers.regex('alpha', /^[a-zA-Z0-9À-ÿ'\+\-\/\u00f1\u00d1\s]*$/)
export const nombreCategoria = nombreText

export const ruc = helpers.regex('alpha', /^(10|20|15|16|17)[1-9]{1}[0-9]{8}$/)
export const dni = helpers.regex('alpha', /^([0-9]{8})$/)
export const nombreNegocio = helpers.regex('alpha', /^[a-zA-ZÀ-ÿ0-9&\u00f1\u00d1\s]*['/]?[a-zA-ZÀ-ÿ0-9&\u00f1\u00d1\s]*$/)
export const numeroTelefonico = helpers.regex('alpha', /^([0-9]{3})?([1-9]{1}[0-9]{5})*$/)
export const numeroCelular = helpers.regex('alpha', /^([9]{1}[0-9]{8})*$/)
export const direccion = helpers.regex('alpha', /^[a-zA-Z0-9À-ÿ.#\u00f1\u00d1\s]*$/)

export default text
