export const rules = {
    required(value) {
        return value.trim() !== ''
    },

    email(value) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)
    },

    minLength(value, length) {
        return value.length >= length
    },

    equalTo(value, selector, form) {
        return value === form.querySelector(selector)?.value
    },

    extension(file, ext) {
        if (!file) return true
        return file.name.toLowerCase().endsWith(`.${ext}`)
    },

    filesize(file, mb) {
        if (!file) return true
        return file.size <= mb * 1024 * 1024
    }
}