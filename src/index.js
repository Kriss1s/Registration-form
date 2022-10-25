// imports
window.htmx = require('htmx.org');
import Alpine from 'alpinejs';
window.Alpine = Alpine;

// get date 
// const date = new Date();
// const today = `${date.getFullYear()}-${date.getMonth() + 1 < 9 ? `0${date.getMonth() + 1}` : date.getMonth() + 1}-${date.getDate() < 9 ? `0${date.getDate()}` : date.getDate()}`;

// alpine
document.addEventListener('alpine:init', () => {
    Alpine.data('validateForm', function () {
        return {
            step: this.$persist(1),
            location: this.$persist(null),
            minDate: today,
            countries: ["UK", "Germany", "Poland", "USA", "China", "Japan", "Ukrain"],
            formData: this.$persist({
                firstName: "",
                lastName: "",
                phoneNumber: "",
                email: "",
                country: "",
                img: "",
                topic: "",
                description: "",
                date: ""
            }),
            errors: {
                firstNameError: "",
                lastNameError: "",
                phoneNumberError: "",
                emailError: "",
                imgError: "",
                countryError: "",
                topicError: "",
                descriptionError: "",
                dateError: ""
            },

            length: {
                nameLength: 2,
                topicLength: 10,
                descriptionLength: 20
            },
            firstSubmit() {
                // console.log(JSON.stringify(this.formData))
                this.checkText(`firstName`, this.length.nameLength);
                this.checkText(`lastName`, this.length.nameLength);
                this.checkNumber();
                this.checkCountry();
                this.checkEmail();
                let warning = Object.values(this.errors).slice(0, 6).some(e => e !== "") || this.formData.img === "";

                if (!warning) {
                    return this.step++;
                }
            },
            async secondSubmit() {
                this.checkText(`topic`, this.length.topicLength);
                this.checkText(`description`, this.length.descriptionLength);
                this.checkDate();
                let warning = Object.values(this.errors).some(e => e !== "") || this.formData.img === "";
                console.log(warning)
                if (!warning) {

                    let result = await (await fetch('./validation', {
                        method: "POST",
                        headers: { "Content-type": "application/json", },
                        body: JSON.stringify(this.formData)
                    })).json();
                    console.log(result)
                    // if (result.status === "success") {
                    //     this.errors.imgError = "";
                    //     this.formData.img = result.imgUrl;
                    // } else {
                    //     this.errors.imgError = result.statusMsg;
                    // }
                    // this.step++;
                }
            },

            checkStep() {
                if (this.step === 1) {
                    return this.firstSubmit()
                } else if (this.step === 2) {
                    return this.secondSubmit()
                } else {
                    return console.log('no')
                }
            },
            checkText(input, minLength, maxLength = 100) {

                if (this.formData[input].length <= minLength) {
                    return this.errors[`${input}Error`] = `Name shoud be minimum ${minLength} letters`
                } else if (this.formData[input].length >= maxLength) {
                    return this.errors[`${input}Error`] = `Name shoud be max ${maxLength} letters`
                } else {
                    return this.errors[`${input}Error`] = "";
                }

            },
            checkNumber() {
                if (this.formData.phoneNumber.length != 15) {
                    return this.errors.phoneNumberError = "invalid number"
                } else {
                    return this.errors.phoneNumberError = ""
                }
            },
            checkCountry() {
                console.log(this.formData.country)
                if (this.countries.every((e) => e !== this.formData.country)) {
                    return this.errors.countryError = "Please choose"
                } else {
                    return this.errors.countryError = ""
                }

            },

            checkEmail() {
                if (!this.formData.email.match(
                    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                )) {
                    return this.errors.emailError = "incorrect email"
                } else {
                    return this.errors.emailError = ""
                }
            },
            checkDate() {
                console.log(this.minDate)
                const userDate = new Date(this.formData.date);
                if (userDate < date) {
                    this.errors.dateError = "incorrect date"
                } else {
                    this.errors.dateError = "";
                }
            },
            async uploadImg(e) {
                let formData = new FormData();
                formData.append('user-img', e[0]);
                let result = await (await fetch('./upload', {

                    method: "POST",
                    body: formData
                })).json();
                console.log(result)
                if (result.status === "success") {
                    this.errors.imgError = "";
                    this.formData.img = result.imgUrl;
                } else {
                    this.errors.imgError = result.statusMsg;
                }
            }

        }
    })
})


Alpine.start();