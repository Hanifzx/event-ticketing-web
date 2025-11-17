<div>
    @if (session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <h3 class="text-lg font-semibold text-gray-900 mb-4">Manajemen Pengguna</h3>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($users as $user)
                    <tr class="@if($user->role == 'organizer' && $user->status == 'pending') bg-yellow-50 @endif">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">{{ $user->role }}</td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            @if($user->role == 'organizer')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($user->status == 'approved') bg-green-100 text-green-800 @elseif($user->status == 'pending') bg-yellow-100 text-yellow-800 @else bg-red-100 text-red-800 @endif">
                                    {{ $user->status }}
                                </span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            
                            @switch($user->role)
                                
                                @case('organizer')
                                    @if($user->status == 'pending' || $user->status == 'rejected')
                                        <button wire:click="approve({{ $user->id }})" class="text-green-600 hover:text-green-900">Approve</button>
                                    @endif
                                    @if($user->status == 'pending' || $user->status == 'approved')
                                        <button wire:click="reject({{ $user->id }})" class="text-red-600 hover:text-red-900 ml-3">Reject</button>
                                    @endif
                                    @break

                                @case('user')
                                    <button wire:click="promoteToAdmin({{ $user->id }})" 
                                            wire:confirm="Anda yakin ingin mempromosikan '{{ $user->name }}' menjadi Admin?"
                                            class="text-indigo-600 hover:text-indigo-900">
                                        Jadikan Admin
                                    </button>
                                    @break

                                @case('admin')
                                    @if($user->is(Auth::user()))
                                        <span class="text-gray-400 text-xs">(Akun Anda)</span>
                                    @endif
                                    @break

                            @endswitch

                            @if(!$user->is(Auth::user()))
                                <button wire:click="deleteUser({{ $user->id }})" 
                                        wire:confirm="Anda yakin ingin menghapus '{{ $user->name }}'?"
                                        class="text-red-600 hover:text-red-900 ml-3">
                                    Hapus
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada pengguna yang terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>