<form wire:submit.prevent="submit" class="contact-form">
    @if (session()->has('contact_success'))
    <div class="alert alert-success">
        {{ session('contact_success') }}
    </div>
    @endif

    <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
            <input type="text" wire:model.defer="form.name" placeholder="{{ __('Your Name') }}" required>
            @error('form.name')
            <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
            <input type="email" wire:model.defer="form.email" placeholder="{{ __('Your Email') }}" required>
            @error('form.email')
            <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
            <input type="text" wire:model.defer="form.phone" placeholder="{{ __('Phone') }}">
            @error('form.phone')
            <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
            <input type="text" wire:model.defer="form.subject" placeholder="{{ __('Subject') }}">
            @error('form.subject')
            <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
            <textarea wire:model.defer="form.message" placeholder="{{ __('Message') }}"></textarea>
            @error('form.message')
            <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn mr-0 centred">
            <button class="theme-btn btn-one" type="submit">
                <span wire:loading.remove wire:target="submit">{{ __('Submit Now') }}</span>
                <span wire:loading wire:target="submit">{{ __('Sending...') }}</span>
            </button>
        </div>
    </div>
</form>