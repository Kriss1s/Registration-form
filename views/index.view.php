<?php include("partials/head.php"); ?>

<body class="flex flex-col items-center h-screen" x-data="validateForm">
    <!-- fb -->
    <!-- <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script> -->
    <!-- <div x-init="location= await(await fetch('https://api.ipbase.com/v2/info?apikey=S0Nl7A4386tXofSbYFSEA4XtMibSoTh74kZnFFQ3&i')).json()"
        class="max-h-[300px] w-full">
        <template x-if="location!=null">
            <iframe width="100%" height="300px" style="border:0" loading="lazy" zoom="50%"
                center="location.data.location.latitude,location.data.location.longitude" allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
                :src="`https://www.google.com/maps/embed/v1/place?key=AIzaSyD3B5J-Vd0i6dDCsOQ2YRnl9ttE7tnd2Ds&q=${location.data.location.city.name}&center=${location.data.location.latitude},${location.data.location.longitude}&zoom=12`">
            </iframe>
        </template>
    </div> -->

    <!-- <template x-if="location!=null">
        <p @click="console.log(location.data);console.log(`https://www.google.com/maps/embed/v1/place?key=AIzaSyD3B5J-Vd0i6dDCsOQ2YRnl9ttE7tnd2Ds
    &q=${location.data.location.city.name}&center=${location.data.location.latitude},${location.data.location.longitude}`)">
            clll</p>
    </template> -->
    <h1 class="text-2xl">Registration</h1>

    <section class="form w-2/4 h-4/5 flex flex-col justify-center">

        <div x-show="step === 1" class="step-1 flex flex-col mt-5 mb-5">
            <input x-model="formData.firstName" @change="checkText('firstName',length.nameLength)" class="border-b-2 border-b-rose-100 mb-5 h-8" type="text" name="first_name" id="first-name" placeholder="First Name">
            <span x-text="errors.firstNameError"></span>
            <input x-model="formData.lastName" @change="checkText('lastName', length.nameLength)" class="border-b-2 border-b-rose-100 mb-5 h-8" type="text" name="last-name" id="last-name" placeholder="Last Name">
            <span x-text="errors.lastNameError"></span>

            <input x-data x-model="formData.phoneNumber" x-mask="+99(999)999-999" @change="checkNumber()" placeholder="+NN (NNN) NNN-NNNN" class="border-b-2 border-b-rose-100 mb-5 h-8" type="text" name="phone" id="phone" placeholder="Number">
            <span x-text="errors.phoneNumberError"></span>

            <input x-model="formData.email" @change="checkEmail()" class="border-b-2 border-b-rose-100 mb-5 h-8" type="email" name="email" id="email" placeholder="Email">
            <span x-text="errors.emailError"></span>

            <select x-model="formData.country" @change="checkCountry()" class="border-b-2 border-b-rose-100 mb-5 h-8" name="country" id="country">

                <template x-for="country in countries">
                    <option :value="country" x-text="country" :selected="country === formData.country ? true : false">
                    </option>
                </template>
            </select>
            <span x-text="errors.countryError"></span>

            <input @change="uploadImg($event.target.files)" class="block file:rounded-lg file:border-none file:mr-5 file:bg-rose-400 file:text-white file:cursor-pointer file:w-4/12  file:h-10 h-10 cursor-pointer mb-5" type="file" accept="image/*" name="user-img" id="user-img">
            <span id="img" x-text="errors.imgError"> </span>
        </div>

        <div x-show="step === 2" class="step-2 flex flex-col mt-5 mb-5">
            <input x-model="formData.topic" @change="checkText('topic',length.topicLength)" class="border-b-2 border-b-rose-100 mb-5 h-8" type="text" name="topic" id="topic" placeholder="Your Topic">
            <span x-text="errors.topicError"> </span>

            <textarea x-model="formData.description" @change="checkText('description', length.descriptionLength,1000)" class="border-b-2 border-b-rose-100 mb-5" name="description" id=""></textarea>
            <span x-text="errors.descriptionError"> </span>

            <input x-model="formData.date" @change="checkDate()" :min="minDate" class="border-b-2 border-b-rose-100 mb-5" type="date" name="date" id="date">
            <span x-text="errors.dateError"> </span>
        </div>
        <div x-show="step === 3" class="step-3">
            <p>Congratulations!</p>
            <!-- <a href="https://twitter.com/intent/tweet?" class="twitter-share-button" data-size="large" :data-text="`Хэй, я выступаю с темой ${formData.topic}! Узнать
больше: ${'lkkk'}`" data-show-count="false">Tweet</a> -->

        </div>
        </div>
    </section>

    <div class="progress-bar flex w-2/4 items-center">
        <button @click="step > 1 && step <=3? step-- : step" class="btn-progress bg-rose-400 text-white rounded-full w-11 h-8">
            <</button>
                <div class="progress-line-container p-1 w-full border-2 rounded-full border-rose-200 flex items-center ml-5 mr-5">
                    <div class="progress-line bg-rose-400 rounded-full transition-width ease duration-500" x-bind:class="step === 1 ? 'w-1/3' : step === 2 ? 'w-2/3': 'w-full'">
                        <span x-text="step"></span>
                    </div>
                </div>
                <button @click="checkStep()" class="btn-progress bg-rose-400 text-white rounded-full w-11 h-8 "> >
                </button>

    </div>
    <!-- scripts -->
    <script src="/dist/main.js"></script>
    
</body>

</html>