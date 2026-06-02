@extends('admin.layouts.app')

@section('content')
<div class="admin-form">
    <div class="form-header">
        <h1>Edit Contact Information</h1>
        <a href="{{ route('admin.partnerships.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.partnerships.contact.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-section">
            <h2>Office Address</h2>

            <div class="form-group">
                <label for="office_address">Office Address</label>
                <textarea id="office_address" name="office_address" rows="3" class="form-control">{{ $contact->office_address ?? old('office_address') }}</textarea>
            </div>

            <div class="form-group">
                <label for="office_location">Location/City</label>
                <input type="text" id="office_location" name="office_location" value="{{ $contact->office_location ?? old('office_location') }}" class="form-control" placeholder="e.g., Addis Ababa, Ethiopia">
            </div>

            <div class="form-group">
                <label for="office_hours">Office Hours</label>
                <textarea id="office_hours" name="office_hours" rows="3" class="form-control" placeholder="Monday - Friday: 8:00 AM - 5:00 PM">{{ $contact->office_hours ?? old('office_hours') }}</textarea>
            </div>
        </div>

        <div class="form-section">
            <h2>Contact Details</h2>

            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ $contact->email ?? old('email') }}" class="form-control" placeholder="partnerships@sphmmc.edu.et">
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" value="{{ $contact->phone ?? old('phone') }}" class="form-control" placeholder="+251-11-XXX-XXXX">
                </div>

                <div class="form-group">
                    <label for="fax">Fax</label>
                    <input type="tel" id="fax" name="fax" value="{{ $contact->fax ?? old('fax') }}" class="form-control">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h2>Additional Information</h2>

            <div class="form-group">
                <label for="website">Website</label>
                <input type="url" id="website" name="website" value="{{ $contact->website ?? old('website') }}" class="form-control" placeholder="https://sphmmc.edu.et">
            </div>

            <div class="form-group">
                <label for="social_media">Social Media Links</label>
                <textarea id="social_media" name="social_media" rows="4" class="form-control" placeholder="Facebook: https://...&#10;Twitter: https://...">{{ $contact->social_media ?? old('social_media') }}</textarea>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save Contact Information</button>
            <a href="{{ route('admin.partnerships.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<style>
.admin-form {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    max-width: 800px;
}

.form-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.form-header h1 {
    font-size: 2rem;
    color: #2D2020;
    margin: 0;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
}

.form-section {
    margin-bottom: 2.5rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid #e2e8f0;
}

.form-section:last-of-type {
    border-bottom: none;
}

.form-section h2 {
    font-size: 1.3rem;
    color: #2D2020;
    margin-bottom: 1.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: #2D2020;
}

.form-control {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    font-family: inherit;
    font-size: 1rem;
}

.form-control:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
}

.error {
    color: #dc3545;
    font-size: 0.9rem;
    margin-top: 0.5rem;
}

.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #e2e8f0;
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    border: none;
    cursor: pointer;
    font-size: 1rem;
}

.btn-primary {
    background: #2563eb;
    color: white;
}

.btn-secondary {
    background: #e2e8f0;
    color: #2D2020;
}
</style>
@endsection
