@extends('layouts.super-admin')

@section('title', 'Create New Company')
@section('page-title', 'Create New Company')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">

    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Create New Company</h2>
                    <p class="mt-1 text-sm text-gray-600">Set up a new company with owner account and subscription plan</p>
                </div>
                <a href="{{ route('super-admin.tenants.index') }}"
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Companies
                </a>
            </div>
        </div>
    </div>

    <!-- Error Summary -->
    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-red-500 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div class="flex-1">
                    <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('super-admin.tenants.store') }}" method="POST" class="space-y-8">
        @csrf

        <!-- Company Information -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Company Information
                </h3>
                <p class="mt-1 text-sm text-gray-600">Basic details about the company</p>
            </div>

            <div class="p-6 space-y-6" style="overflow: visible;">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Company Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Company Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('name') border-red-500 @enderror"
                               placeholder="Enter company name"
                               required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Company Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Company Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('email') border-red-500 @enderror"
                               placeholder="company@example.com"
                               required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Phone Number
                        </label>
                        <input type="text"
                               id="phone"
                               name="phone"
                               value="{{ old('phone') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('phone') border-red-500 @enderror"
                               placeholder="+234 xxx xxx xxxx">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Business Type -->
                    <div class="relative" style="z-index: 10;">
                        <label for="business_type" class="block text-sm font-medium text-gray-700 mb-2">
                            Business Type <span class="text-red-500">*</span>
                        </label>
                        <select id="business_type"
                                name="business_type"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('business_type') border-red-500 @enderror"
                                required>
                            <option value="">Select business type</option>
                            @foreach($businessTypes as $type)
                                <option value="{{ $type->id}}" {{ old('business_type') === $type->id? 'selected' : '' }}>
                                    {{ $type->icon ? $type->icon . ' ' : '' }}{{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('business_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <br />
            <br /><br /><br /><br /><br />

        </div>

        

        <!-- Owner Account -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-green-50 to-emerald-50">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Owner Account
                </h3>
                <p class="mt-1 text-sm text-gray-600">Create the primary owner account for this company</p>
            </div>

            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Owner Name -->
                    <div>
                        <label for="owner_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Owner Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="owner_name"
                               name="owner_name"
                               value="{{ old('owner_name') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('owner_name') border-red-500 @enderror"
                               placeholder="Enter owner's full name"
                               required>
                        @error('owner_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Owner Email -->
                    <div>
                        <label for="owner_email" class="block text-sm font-medium text-gray-700 mb-2">
                            Owner Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email"
                               id="owner_email"
                               name="owner_email"
                               value="{{ old('owner_email') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('owner_email') border-red-500 @enderror"
                               placeholder="owner@company.com"
                               required>
                        @error('owner_email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Owner Password -->
                    <div>
                        <label for="owner_password" class="block text-sm font-medium text-gray-700 mb-2">
                            Owner Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password"
                               id="owner_password"
                               name="owner_password"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('owner_password') border-red-500 @enderror"
                               placeholder="Create a secure password"
                               required>
                        @error('owner_password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="owner_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirm Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password"
                               id="owner_password_confirmation"
                               name="owner_password_confirmation"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('owner_password_confirmation') border-red-500 @enderror"
                               placeholder="Confirm the password"
                               required>
                        @error('owner_password_confirmation')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('super-admin.tenants.index') }}"
               class="px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                Cancel
            </a>
            <button type="submit"
                    class="px-6 py-3 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                Create Company
            </button>
        </div>
    </form>

    <!-- Additional Actions -->
    {{-- <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-amber-50 to-orange-50">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Alternative: Send Invitation
            </h3>
            <p class="mt-1 text-sm text-gray-600">Instead of creating an account directly, you can send an invitation email</p>
        </div>

        <div class="p-6">
            <p class="text-sm text-gray-600 mb-4">
                If you prefer, you can send an invitation email to the company owner instead of creating their account directly.
                This allows them to set up their own password and complete the onboarding process.
            </p>
            <a href="{{ route('super-admin.tenants.invite') }}"
               class="inline-flex items-center px-4 py-2 border border-amber-300 rounded-lg text-sm font-medium text-amber-700 bg-amber-50 hover:bg-amber-100 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
                Send Invitation Instead
            </a>
        </div>
    </div> --}}

</div>

<!-- Choices.js for searchable select -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<style>
/* Custom styling for Choices.js to match Tailwind design */
.choices__inner {
    padding: 0.75rem 1rem !important;
    border-radius: 0.5rem !important;
    min-height: 48px !important;
    font-size: 0.875rem !important;
    border: 1px solid #d1d5db !important;
}
.choices__list--dropdown {
    z-index: 100 !important;
}
.choices__list--dropdown .choices__item--selectable {
    padding: 0.75rem 1rem !important;
}
.choices[data-type*="select-one"] .choices__input {
    padding: 0.5rem !important;
}
.choices__list--dropdown .choices__item--selectable.is-highlighted {
    background-color: #3b82f6 !important;
}
</style>

<script>
// Form validation and enhancement
document.addEventListener('DOMContentLoaded', function() {
    // Initialize searchable select for business type
    const businessTypeSelect = document.getElementById('business_type');
    if (businessTypeSelect) {
        new Choices(businessTypeSelect, {
            searchEnabled: true,
            searchPlaceholderValue: 'Search business type...',
            itemSelectText: 'Click to select',
            shouldSort: false,
            removeItemButton: false,
        });
    }

    // Auto-fill owner email when company email changes
    const companyEmail = document.getElementById('email');
    const ownerEmail = document.getElementById('owner_email');

    companyEmail.addEventListener('blur', function() {
        if (!ownerEmail.value && companyEmail.value) {
            const domain = companyEmail.value.split('@')[1];
            if (domain) {
                ownerEmail.placeholder = `owner@${domain}`;
            }
        }
    });

    // Form submission confirmation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const companyName = document.getElementById('name').value;
        const ownerName = document.getElementById('owner_name').value;

        if (!confirm(`Are you sure you want to create company "${companyName}" with owner "${ownerName}"?`)) {
            e.preventDefault();
        }
    });
});
</script>
@endsection
