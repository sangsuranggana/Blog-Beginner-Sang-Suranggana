<footer class="relative bg-white/20 backdrop-blur-lg w-full px-4 flex flex-col justify-center items-center md:mt-6 mt-12">
    <div>
        <div class="flex md:flex-row flex-col md:gap-12 xl:gap-24 gap-6">
            <img src="{{ asset('svg/logo.svg') }}" alt="" class="h-8 place-self-start order-1 md:order-1">
            <!-- Contact Section -->
            <div class="flex flex-col gap-4 order-3 md:order-2">
                <p class="text-lg font-bold text-black">Hubungi kami</p>
                <p class="text-sm text-black">Jl. Raya Janti, Gang Arjuna No.59, Karangjambe, Banguntapan, Bantul, Yogyakarta 55198</p>
                <p class="text-sm text-black">customer.care@antarpaket.com</p>
                <p class="text-sm text-black">(+62) 14-9363-3879</p>
            </div>
            <!-- Information Links -->
            <div class="flex flex-col gap-4 order-4 md:order-3">
                <p class="text-lg font-bold text-black">Informasi</p>
                <a href={{ route('blog.index') }} class="text-sm text-black">Blog</a>
                <a href={{ route('syarat') }} class="text-sm text-black">Syarat dan Ketentuan</a>
                <a href={{ route('tipe.pengiriman') }} class="text-sm text-black">Pengiriman</a>
                <a href={{ route('merchandise') }} class="text-sm text-black">Merchandise</a>
            </div>
            <!-- Social Media Links -->
            <div class="flex flex-col gap-4 order-2 md:order-4">
                <p class="text-lg font-bold text-black">Ikuti Kami</p>
                <div class="flex flex-row gap-4">
                    <img src="svg/facebook.svg" alt="facebook" />
                    <img src="svg/twitter.svg" alt="twitter" />
                    <img src="svg/insta.svg" alt="instagram" />
                </div>
            </div>
        </div>
        <p class="text-sm my-10 text-end text-black">Antar Paket ©2024 All Rights Reserved</p>
    </div>

</footer>
