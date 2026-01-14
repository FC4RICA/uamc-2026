import { rules } from './rules'

export function validateForm(form, config) {
    let valid = true

    Object.entries(config).forEach(([name, fieldRules]) => {
        const input = form.querySelector(`[name="${name}"]`)
        if (!input) return

        const value = input.type === 'file'
            ? input.files[0]
            : input.value

        for (const rule of fieldRules) {
            const [ruleName, param, message] = rule
            const result = rules[ruleName](value, param, form)

            if (!result) {
                showError(input, message)
                valid = false
                break
            } else {
                clearError(input)
            }
        }
    })

    return valid
}

function showError(input, message) {
    input.classList.add('inputerror')

    let error = input.nextElementSibling
    if (!error || !error.classList.contains('error')) {
        error = document.createElement('div')
        error.className = 'error'
        input.after(error)
    }
    error.textContent = message
}

function clearError(input) {
    input.classList.remove('inputerror')
    const error = input.nextElementSibling
    if (error?.classList.contains('error')) {
        error.remove()
    }
}
