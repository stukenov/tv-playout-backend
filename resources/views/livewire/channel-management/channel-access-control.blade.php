<div class="p-6 bg-white rounded-lg shadow-md">
    <form wire:submit.prevent="assignRole" class="space-y-4">
        <div>
            <label for="selectedUser" class="block text-sm font-medium text-gray-700">Select User</label>
            <select id="selectedUser" wire:model="selectedUser" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value="">Choose a user</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('selectedUser') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="selectedRole" class="block text-sm font-medium text-gray-700">Select Role</label>
            <select id="selectedRole" wire:model="selectedRole" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value="">Choose a role</option>
                @foreach($roles as $role)
                    <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                @endforeach
            </select>
            @error('selectedRole') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Assign Role</button>
    </form>

    <h3 class="mt-6 text-lg font-medium text-gray-900">Current Roles</h3>
    <ul class="mt-2 space-y-2">
        @foreach($channelRoles as $role)
            <li class="text-sm text-gray-700">{{ $role->user->name }} - {{ ucfirst($role->role) }}</li>
        @endforeach
    </ul>
</div>