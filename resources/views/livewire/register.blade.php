<div>
    <form wire:submit.prevent="register">
        <label for="name">名前</label>
        <input id="name" type="text" wire:model.lazy="name">
        @error('name') <div class="text-red-500">{{$message}}</div> @enderror

        <label for="email">email</label>
        <input id="email" type="email" wire:model.lazy="email">
        @error('email') <div class="text-red-500">{{$message}}</div> @enderror

        <label for="password">password</label>
        <input id="pssword" type="password" wire:model.lazy="password">
        @error('password') <div class="text-red-500">{{$message}}</div> @enderror

        <button>登録する</button>
    </form>
</div>