@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Personal Information Section -->
                                <div class="card-header-2 mb-4">
                                    <h5>Personal Information</h5>
                                    <p>Welcome applicant: {{ $applicant->fullname }} / {{ $applicant->appno }} <br>
                                        Continue your application.</p>
                                </div>
                                <form method="POST" action="{{ route('application.update', $applicant['appno']) }}"
                                    class="theme-form theme-form-2 mega-form">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="appno" value="{{ $applicant['appno'] }}">

                                    <div class="row">
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-4">Full Name</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" name="fullname"
                                                    value="{{ $applicant['fullname'] ?? '' }}" type="text"
                                                    placeholder="Full Name" required>
                                            </div>

                                            <label class="form-label-title col-sm-2 mb-4">Email Address</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" value="{{ $applicant['email_address'] ?? '' }}"
                                                    name="email_address" type="email" placeholder="Email Address"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-2 mb-4 col-form-label form-label-title">Gender</label>
                                            <div class="col-sm-4 mb-4">
                                                <select class="js-example-basic-single w-100" name="sex" required>
                                                    <option value="{{ $applicant['sex'] }}" selected='selected'>
                                                        {{ $applicant['sex'] ?? '' }}</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>

                                            <label class="col-lg-2 col-md-3 mb-4 col-form-label form-label-title">Date Of
                                                Birth</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" value="{{ $applicant['date_of_birth'] ?? '' }}"
                                                    name="date_of_birth" type="date" placeholder="Date Of Birth"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center nigeriaFields">
                                            <label class="col-sm-2 mb-4 col-form-label form-label-title">Country</label>
                                            <div class="col-sm-4 mb-4" id="internationalFields" style="display: none;">
                                                <select class="js-example-basic-single w-100" name="country" id="country"
                                                    required>
                                                    <option value="{{ $applicant['country'] }}" selected='selected'>
                                                        {{ $applicant['country'] ?? '' }}</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>

                                            <label class="col-sm-2 mb-4 col-form-label form-label-title">State</label>
                                            <div class="col-sm-4 mb-4">
                                                <select class="js-example-basic-single w-100" name="state_of_origin"
                                                    id="state" onchange="selectLGA(this)" required>
                                                    <option value="{{ $applicant['state_of_origin'] }}"
                                                        selected='selected'>
                                                        {{ $applicant['state_of_origin'] ?? '' }}</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-2 mb-4 col-form-label form-label-title">LGA</label>
                                            <div class="col-sm-4 mb-4">
                                                <select class="js-example-basic-single w-100" name="lga" id="lga"
                                                    required>
                                                    <option disabled>LGA Menu</option>
                                                    <option value="{{ $applicant['lga'] }}" selected='selected'>
                                                        {{ $applicant['lga'] ?? '' }}</option>
                                                </select>
                                            </div>

                                            <label class="col-sm-2 mb-4 col-form-label form-label-title">Home Town</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" value="{{ $applicant->home_town }}"
                                                    name="home_town" type="text" placeholder="Home Town">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-2 mb-4 col-form-label form-label-title">Address</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control"
                                                    value="{{ $applicant['contact_address'] ?? '' }}"
                                                    name="contact_address" type="text" placeholder="Address" required>
                                            </div>

                                            <label class="col-sm-2 mb-4 col-form-label form-label-title">Phone
                                                Number</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" value="{{ $applicant['phone_no'] ?? '' }}"
                                                    name="phone_no" type="text" placeholder="Phone Number" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Choice of Course Section -->
                                    <div class="card-header-2 mb-4 mt-5">
                                        <h5>Choice of Course</h5>
                                    </div>

                                    <div class="row">
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-4">Course of Study</label>
                                            <div class="col-sm-4 mb-4">
                                                <select name="first_choice" class="form-control" id="programme" required>
                                                    <option value="" disabled selected>Select Program</option>
                                                    @foreach ($programmes as $programme)
                                                        <option value="{{ $programme->name }}"
                                                            {{ $applicant['first_choice'] == $programme->name ? 'selected' : '' }}>
                                                            {{ $programme->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <label class="form-label-title col-sm-2 mb-4">Department</label>
                                            <div class="col-sm-4 mb-4">
                                                <input type="text" name="department"
                                                    value="{{ $applicant['department'] ?? '' }}" class="form-control"
                                                    id="department" readonly>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-4">Faculty</label>
                                            <div class="col-sm-4 mb-4">
                                                <input type="text" name="faculty"
                                                    value="{{ $applicant['faculty'] ?? '' }}" class="form-control"
                                                    id="faculty" readonly>
                                            </div>

                                            <label class="form-label-title col-sm-2 mb-4">Session</label>
                                            <div class="col-sm-4 mb-4">
                                                <input type="text" name="sessions"
                                                    value="{{ $applicant['sessions'] ?? '' }}" class="form-control"
                                                    id="" readonly>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-4">Highest Qualification</label>
                                            <div class="col-sm-4 mb-4">
                                                <select name="qualification" class="form-control" required>
                                                    <option value="" disabled selected>Select Qualification</option>
                                                    <option value="Undergraduate (BSc)"
                                                        {{ $applicant['qualification'] == 'Undergraduate (BSc)' ? 'selected' : '' }}>
                                                        Undergraduate (BSc)</option>
                                                    <option value="Postgraduate Diploma (PGD)"
                                                        {{ $applicant['qualification'] == 'Postgraduate Diploma (PGD)' ? 'selected' : '' }}>
                                                        Postgraduate Diploma (PGD)</option>
                                                    <option value="Postgraduate (MSc)"
                                                        {{ $applicant['qualification'] == 'Postgraduate (MSc)' ? 'selected' : '' }}>
                                                        Postgraduate (MSc)</option>
                                                    <option value="Postgraduate (PhD)"
                                                        {{ $applicant['qualification'] == 'Postgraduate (PhD)' ? 'selected' : '' }}>
                                                        Postgraduate (PhD)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="button login button-1 text-center mt-4">
                                        <button class="btn btn-primary" type="submit">
                                            <span>Save</span>
                                            <i class="fa fa-check"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript remains the same -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Starting country loading process...');

            // First try with https
            fetchCountryData('https://restcountries.com/v3.1/all')
                .catch(error => {
                    console.log('HTTPS failed, trying HTTP fallback');
                    return fetchCountryData('http://restcountries.com/v3.1/all');
                })
                .catch(error => {
                    console.error('Both HTTPS and HTTP failed, using static list');
                    useStaticCountries();
                });

            function fetchCountryData(url) {
                return fetch(url)
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        populateCountries(data);
                        return true;
                    });
            }

            function populateCountries(data) {
                try {
                    const countrySelect = document.getElementById('country');
                    if (!countrySelect) {
                        console.error('Country select element not found');
                        return;
                    }

                    // Clear existing options except the first one
                    while (countrySelect.options.length > 1) {
                        countrySelect.remove(1);
                    }

                    data.sort((a, b) => a.name.common.localeCompare(b.name.common));

                    data.forEach(country => {
                        const option = document.createElement('option');
                        option.value = country.name.common;
                        option.textContent = country.name.common;
                        countrySelect.appendChild(option);
                    });

                    const internationalFields = document.getElementById('internationalFields');
                    if (internationalFields) {
                        internationalFields.style.cssText = 'display: block !important';
                        console.log('Country dropdown populated and shown');
                    } else {
                        console.error('internationalFields element not found');
                    }
                } catch (e) {
                    console.error('Error populating countries:', e);
                    throw e; // Re-throw to trigger fallback
                }
            }

            function useStaticCountries() {
                const staticCountries = [{
                        name: {
                            common: 'Algeria'
                        }
                    },
                    {
                        name: {
                            common: 'Angola'
                        }
                    },
                    {
                        name: {
                            common: 'Benin'
                        }
                    },
                    {
                        name: {
                            common: 'Botswana'
                        }
                    },
                    {
                        name: {
                            common: 'Burkina Faso'
                        }
                    },
                    {
                        name: {
                            common: 'Burundi'
                        }
                    },
                    {
                        name: {
                            common: 'Cabo Verde'
                        }
                    },
                    {
                        name: {
                            common: 'Cameroon'
                        }
                    },
                    {
                        name: {
                            common: 'Central African Republic'
                        }
                    },
                    {
                        name: {
                            common: 'Chad'
                        }
                    },
                    {
                        name: {
                            common: 'Comoros'
                        }
                    },
                    {
                        name: {
                            common: 'Congo (Brazzaville)'
                        }
                    },
                    {
                        name: {
                            common: 'Congo (Kinshasa)'
                        }
                    },
                    {
                        name: {
                            common: 'Côte d’Ivoire'
                        }
                    },
                    {
                        name: {
                            common: 'Djibouti'
                        }
                    },
                    {
                        name: {
                            common: 'Egypt'
                        }
                    },
                    {
                        name: {
                            common: 'Equatorial Guinea'
                        }
                    },
                    {
                        name: {
                            common: 'Eritrea'
                        }
                    },
                    {
                        name: {
                            common: 'Eswatini'
                        }
                    },
                    {
                        name: {
                            common: 'Ethiopia'
                        }
                    },
                    {
                        name: {
                            common: 'Gabon'
                        }
                    },
                    {
                        name: {
                            common: 'Gambia'
                        }
                    },
                    {
                        name: {
                            common: 'Ghana'
                        }
                    },
                    {
                        name: {
                            common: 'Guinea'
                        }
                    },
                    {
                        name: {
                            common: 'Guinea-Bissau'
                        }
                    },
                    {
                        name: {
                            common: 'Kenya'
                        }
                    },
                    {
                        name: {
                            common: 'Lesotho'
                        }
                    },
                    {
                        name: {
                            common: 'Liberia'
                        }
                    },
                    {
                        name: {
                            common: 'Libya'
                        }
                    },
                    {
                        name: {
                            common: 'Madagascar'
                        }
                    },
                    {
                        name: {
                            common: 'Malawi'
                        }
                    },
                    {
                        name: {
                            common: 'Mali'
                        }
                    },
                    {
                        name: {
                            common: 'Mauritania'
                        }
                    },
                    {
                        name: {
                            common: 'Mauritius'
                        }
                    },
                    {
                        name: {
                            common: 'Morocco'
                        }
                    },
                    {
                        name: {
                            common: 'Mozambique'
                        }
                    },
                    {
                        name: {
                            common: 'Namibia'
                        }
                    },
                    {
                        name: {
                            common: 'Niger'
                        }
                    },
                    {
                        name: {
                            common: 'Nigeria'
                        }
                    },
                    {
                        name: {
                            common: 'Rwanda'
                        }
                    },
                    {
                        name: {
                            common: 'Sao Tome and Principe'
                        }
                    },
                    {
                        name: {
                            common: 'Senegal'
                        }
                    },
                    {
                        name: {
                            common: 'Seychelles'
                        }
                    },
                    {
                        name: {
                            common: 'Sierra Leone'
                        }
                    },
                    {
                        name: {
                            common: 'Somalia'
                        }
                    },
                    {
                        name: {
                            common: 'South Africa'
                        }
                    },
                    {
                        name: {
                            common: 'South Sudan'
                        }
                    },
                    {
                        name: {
                            common: 'Sudan'
                        }
                    },
                    {
                        name: {
                            common: 'Tanzania'
                        }
                    },
                    {
                        name: {
                            common: 'Togo'
                        }
                    },
                    {
                        name: {
                            common: 'Tunisia'
                        }
                    },
                    {
                        name: {
                            common: 'Uganda'
                        }
                    },
                    {
                        name: {
                            common: 'Zambia'
                        }
                    },
                    {
                        name: {
                            common: 'Zimbabwe'
                        }
                    }
                ];
                populateCountries(staticCountries);
            }
        });
        fetch('https://nga-states-lga.onrender.com/fetch')
            .then((res) => res.json())
            .then((data) => {
                var x = document.getElementById("state");
                for (let index = 0; index < Object.keys(data).length; index++) {
                    var option = document.createElement("option");
                    option.text = data[index];
                    option.value = data[index];
                    x.add(option);
                }
            });

        function selectLGA(target) {
            var state = target.value;
            fetch('https://nga-states-lga.onrender.com/?state=' + state)
                .then((res) => res.json())
                .then((data) => {
                    var x = document.getElementById("lga");
                    var select = document.getElementById("lga");
                    var length = select.options.length;
                    for (i = length - 1; i >= 0; i--) {
                        select.options[i] = null;
                    }
                    for (let index = 0; index < Object.keys(data).length; index++) {
                        var option = document.createElement("option");
                        option.text = data[index];
                        option.value = data[index];
                        x.add(option);
                    }
                });
            }

            document.getElementById('programme').addEventListener('change', function() {
            const programmeName = this.value;
            if (programmeName) {
                fetch(`/programme?name=${programmeName}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('department').value = data.department.name;
                        document.getElementById('faculty').value = data.department.faculty.name;
                    });
            } else {
                document.getElementById('department').value = '';
                document.getElementById('faculty').value = '';
            }
        });
    </script>
    <script>
    
    </script>
@endsection
