<x-layout>

    <x-home.hero/>
    <x-home.tools/>
    <x-home.service :services="$services"/> 
    <x-home.project :portos="$portos"/>
    <x-home.faq :faqs="$faqs"/>
    <x-home.contact
    address="925 Filbert Street Pennsylvania 18072"
    email="info@gmail.com"
    phone="+45 3411-4411"
    whatsapp="+6281234567890"
    />

</x-layout>

