<div class="relative w-full h-[500px] md:h-[420px] overflow-hidden">
    <img src="{{ $src }}" class="w-full h-full object-cover" alt="{{ $alt ?? '' }}" />
    <div class="absolute inset-0 bg-black/40"></div>
    <div class="absolute inset-0 flex items-end px-[16px] md:px-[48px] pb-[58px] md:pb-[64px] lg:pb-[74px]">
        <h1 class="text-white text-[32px] md:text-[36px] lg:text-[44px] font-bold leading-[120%]">{!! $title !!}</h1>
    </div>
</div>
