import {helpers} from 'vuelidate/lib/validators'

export const text = helpers.regex('alpha', /^[a-zA-Z0-9À-ÿ.\u00f1\u00d1\s]*$/)
export const nombreText = helpers.regex('alpha', /^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]*$/)

export const nombreProducto = helpers.regex('alpha', /^[a-zA-Z0-9À-ÿ\+\-\/\u00f1\u00d1\s]*$/)
export const nombreProductoDescripcion = helpers.regex('alpha', /^[a-zA-Z0-9À-ÿ'\+\-\/\u00f1\u00d1\s]*$/)
export const nombreCategoria = nombreText


export default text
