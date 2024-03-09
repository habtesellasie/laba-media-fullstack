<footer id="footer">
    <style>
        #footer {
            position: relative;
        }

        .top-link {
            font-size: 1.25rem;
            position: fixed;
            bottom: 1rem;
            right: 1rem;
            background: var(--clr-blue);
            width: 2.5rem;
            height: 2.5rem;
            display: grid;
            place-items: center;
            border-radius: 15px;
            overflow: hidden;
            color: var(--foreground);
            visibility: hidden;
            z-index: -100;
            transition: var(--transition-usual);
        }

        .show-link {
            visibility: visible;
            z-index: 100;
        }

        .show-link i {
            pointer-events: none;
            border: none;
        }
    </style>
    <h1 class="footer__title">Contact Us</h1>
    <div class="footer__container">
        <section class="location">
            <div class="location__img-holder" style="display: flex; align-items: center; justify-content: center;
            ">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3940.486492774005!2d38.82095427619818!3d9.01930708913818!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164b9b9649499655%3A0x525cd0080a1d9e1a!2sLaba%20Media%20and%20Communications!5e0!3m2!1sen!2set!4v1709963480354!5m2!1sen!2set" width="450" height="450" style="border:0;" allowfullscreen="" style="width: 100%; max-width: 450px; margin: 0 auto; text-align: center;" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>
        <section id="contact">
            <div class="form-wrapper">
                <form action="" method="POST">
                    <div class="form-control_flex">
                        <div class="form-control">
                            <input type="text" id="name" name="name" maxlength="20" required />
                            <label for="name">Name*</label>
                        </div>
                        <div class="form-control">
                            <input type="text" id="phone_number" maxlength="16" name="phone_number" required />
                            <label for="phone_number">Phone no.*</label>
                        </div>
                    </div>
                    <div class="form-control">
                        <input type="email" id="email" name="email" maxlength="40" required />
                        <label for="email">Email*</label>
                    </div>
                    <div class="form-control">
                        <textarea name="message" id="message" rows="10" maxlength="500" required></textarea>
                        <label for="message">Message*</label>
                    </div>
                    <p class="warning" style="color: var(--clr-warning);"></p>
                    <div class="form-control">
                        <input type="submit" value="SEND" class="btn" />
                    </div>
                </form>
            </div>
        </section>
    </div>
    <a class="scroll-link top-link" href="#header">
        <i class="fas fa-arrow-up" style="font-style: normal">☝︎</i>
    </a>
    <div class="social__media">
        <a href="" target="_blank" class="social__media-links">twitter</a>
        <a href="" target="_blank" class="social__media-links">facebook</a>
        <a href="" target="_blank" class="social__media-links">linkdin</a>
        <a href="" target="_blank" class="social__media-links">instagram</a>
    </div>
</footer>
<div class="year__container">
    &copy; All right reserved <span class="year__container-text"></span>
</div>
</body>
<script src="./app/functionalities.js"></script>
<script src="./app/theme.js"></script>
<!-- <script src="./app/testimonialPart.js"></script> -->
<script src="./app/Alltransitions.js"></script>

</html>