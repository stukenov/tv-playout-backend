<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Manage Permissions</h2>

    <div class="mb-4">
        <h3 class="text-lg font-semibold mb-2">Add Permission</h3>
        <form wire:submit.prevent="addPermission" class="flex items-center gap-2">
            <select
                wire:model="selectedUser"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            >
                <option value="">Select User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <select
                wire:model="permissionLevel"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            >
                <option value="view">View</option>
                <option value="edit">Edit</option>
                <option value="delete">Delete</option>
            </select>
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Add Permission
            </button>
        </form>
        @error('selectedUser') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        @error('permissionLevel') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <h3 class="text-lg font-semibold mb-2">Current Permissions</h3>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">User</th>
                    <th class="py-2 px-4 border-b">Permission Level</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $permission->user->name }}</td>
                        <td class="py-2 px-4 border-b">
                            <select
                                wire:change="updatePermission({{ $permission->id }}, $event.target.value)"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            >
                                <option value="view" {{ $permission->permission_level === 'view' ? 'selected' : '' }}>View</option>
                                <option value="edit" {{ $permission->permission_level === 'edit' ? 'selected' : '' }}>Edit</option>
                                <option value="delete" {{ $permission->permission_level === 'delete' ? 'selected' : '' }}>Delete</option>
                            </select>
                        </td>
                        <td class="py-2 px-4 border-b">
                            <button
                                wire:click="removePermission({{ $permission->id }})"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-sm"
                            >
                                Remove
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>