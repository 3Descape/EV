export default class Errors {
    constructor() {
        this.errors = {};
    }

    setErrors(errors) {
        this.errors = errors;
    }

    clearErrors() {
        this.errors = {};
    }

    getError(name) {
        return this.errors[name];
    }

    hasError(name) {
        if (this.errors.hasOwnProperty(name)) {
            return this.errors[name];
        }
        return null;
    }
}