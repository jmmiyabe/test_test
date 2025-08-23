<div class="mb-5">
    <div class="max-w-7xl mx-auto bg-white rounded-md shadow-md mt-5 p-6">
        <div class="bg-prims-yellow-1 rounded-lg p-4">
            <h2 class="text-lg font-semibold">Personal Information</h2>
        </div>
        <form wire:submit.prevent="submit">
        <div class="grid grid-cols-4 gap-4 my-4">
            <div>
                <label class="text-lg">ID Number</label>
                <input type="text" wire:model.lazy="apc_id_number" wire:change="searchPatient" class="border p-2 rounded w-full" placeholder="Enter an ID number">
            </div>
            <div>
                <label class="text-lg">First Name</label>
                <input type="text" wire:model="first_name" class="border p-2 rounded w-full bg-gray-200" readonly>
                <input type="hidden" wire:model="first_name">
            </div>
            <div>
                <label class="text-lg">Middle Initial</label>
                <input type="text" wire:model="mi" class="border p-2 rounded w-full bg-gray-200" readonly>
                <input type="hidden" wire:model="mi">
            </div>
            <div>
                <label class="text-lg">Last Name</label>
                <input type="text" wire:model="last_name" class="border p-2 rounded w-full bg-gray-200" readonly>
                <input type="hidden" wire:model="last_name">
            </div>
            <div>
                <label class="text-lg">Gender</label>
                <input type="text" wire:model="gender" class="border p-2 rounded w-full col-span-2 bg-gray-200" readonly>
                <input type="hidden" wire:model="gender"> 
            </div>
            <div>
                <label class="text-lg">Age</label>
                <input type="text" wire:model="age" class="border p-2 rounded w-full col-span-2 bg-gray-200" readonly>
                <input type="hidden" wire:model="age">
            </div>
            <div>
                <label class="text-lg">Date of Birth</label>
                <input type="text" wire:model="dob" class="border p-2 rounded w-full col-span-2 bg-gray-200" readonly>
                <input type="hidden" wire:model="dob"> 
            </div>
            <div>
                <label class="text-lg">Email</label>
                <input type="text" wire:model="email" class="border p-2 rounded w-full col-span-2 bg-gray-200" readonly>
                <input type="hidden" wire:model="email">
            </div>
            <div>
                <label class="text-lg">House/Unit No. & Street</label>
                <input type="text" wire:model="street_number" class="border p-2 rounded w-full col-span-2 bg-gray-200" readonly>
                <input type="hidden" wire:model="first_name"> 
            </div>
            <div>
                <label class="text-lg">Barangay</label>
                <input type="text" wire:model="barangay" class="border p-2 rounded w-full col-span-2 bg-gray-200" readonly>
                <input type="hidden" wire:model="first_name"> 
            </div>
            <div>
                <label class="text-lg">City/Municipality</label>
                <input type="text" wire:model="city" class="border p-2 rounded w-full col-span-2 bg-gray-200" readonly>
                <input type="hidden" wire:model="first_name">
            </div>        
            <div>
                <label class="text-lg">Province</label>
                <input type="text" wire:model="province" class="border p-2 rounded w-full col-span-2 bg-gray-200" readonly>
                <input type="hidden" wire:model="first_name">
            </div>
            <div>
                <label class="text-lg">ZIP Code</label>
                <input type="text" wire:model="zip_code" class="border p-2 rounded w-full col-span-2 bg-gray-200" readonly>
                <input type="hidden" wire:model="first_name">
            </div>
            <div>
                <label class="text-lg">Country</label>
                <input type="text" wire:model="country" class="border p-2 rounded w-full col-span-2 bg-gray-200" readonly>
                <input type="hidden" wire:model="first_name">
            </div>
            <div>
                <label class="text-lg">Contact Number</label>
                <input type="text" wire:model="contact_number" class="border p-2 rounded w-full col-span-2 bg-gray-200" readonly>
                <input type="hidden" wire:model="contact_number">
            </div>
            <div>
                <label class="text-lg">Nationality</label>
                <input type="text" wire:model="nationality" class="border p-2 rounded w-full col-span-2 bg-gray-200" readonly>
                <input type="hidden" wire:model="nationality">
            </div>
        </div>

        <div class="mt-6 bg-prims-yellow-1 rounded-lg p-4">
            <h2 class="text-lg font-semibold">Medical Concern</h2>
        </div>
            <div class="mt-6">
                <label class="block text-lg font-medium">Reason for Visit</label>
                <select wire:model="reason" class="w-full p-2 border rounded-md mb-6">
                    <option value="">Select a reason</option>
                    <option value="Consultation">Consultation</option>
                    <option value="Fever">Fever</option>
                    <option value="Emergency">Headache</option>
                    <option value="Injury">Injury</option>
                    <option value="Other">Other</option>
                </select>

                <label class="font-medium text-lg">Description of Symptoms</label>
                <textarea wire:model="description" class="w-full border p-2 rounded mb-5" placeholder="Description of symptoms..."></textarea>

                <label class="font-medium text-lg mt-2">Allergies</label>
                <textarea wire:model="allergies" class="w-full border p-2 rounded" placeholder="Allergies..."></textarea>

                <div class="mt-6 bg-prims-yellow-1 rounded-lg p-4">
                    <h3 class="text-lg font-semibold">Past Medical History</h3>
                </div>
                    <div class="text-md grid grid-cols-2 md:grid-cols-4 gap-4 m-4">
                        @foreach ($past_medical_history as $key => $value)
                            @if ($key === 'Hepatitis')
                                <div class="flex flex-col my-2">
                                    <span class="font-bold text-lg">{{ $key }}</span>
                                    <div class="flex flex-wrap gap-4 mt-1">
                                        @foreach (['A', 'B', 'C', 'D', 'None'] as $type)
                                            <label class="flex items-center space-x-1">
                                                <input type="radio" wire:model="past_medical_history.Hepatitis" value="{{ $type }}" class="accent-black">
                                                <span>{{ $type }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="flex flex-col my-2">
                                    <span class="font-bold text-lg">{{ $key }}</span>
                                    <div class="flex gap-4 mt-1">
                                        <label class="flex items-center space-x-1">
                                            <input type="radio" wire:model="past_medical_history.{{ $key }}" value="Yes" class="accent-black">
                                            <span>Yes</span>
                                        </label>
                                        <label class="flex items-center space-x-1">
                                            <input type="radio" wire:model="past_medical_history.{{ $key }}" value="No" class="accent-black">
                                            <span>No</span>
                                        </label>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                <div class="mt-6 bg-prims-yellow-1 rounded-lg p-4">
                    <h3 class="text-lg font-semibold">Family History</h3>
                </div>
                    <div class="text-md grid grid-cols-2 md:grid-cols-4 gap-4 m-4">
                        @foreach ($family_history as $key => $value)
                            <div class="flex flex-col my-2">
                                <span class="font-bold text-lg">{{ $key }}</span>
                                <div class="flex gap-4 mt-1">
                                    <label class="flex items-center space-x-1">
                                        <input type="radio" wire:model="family_history.{{ $key }}" value="Yes" class="accent-black">
                                        <span>Yes</span>
                                    </label>
                                    <label class="flex items-center space-x-1">
                                        <input type="radio" wire:model="family_history.{{ $key }}" value="No" class="accent-black">
                                        <span>No</span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 bg-prims-yellow-1 rounded-lg p-4">
                        <h3 class="text-lg font-semibold">Personal & Social History</h3>
                    </div>
                    <div class="text-md grid grid-cols-2 md:grid-cols-4 gap-4 m-4">
                        <!-- Smoke Input -->
                        <div class="col-span-2 flex flex-col">
                            <label class="text-lg font-bold">Smoke</label>
                            <div class="flex items-center gap-4">
                                <label class="text-md">Sticks/day:</label>
                                <input type="number" wire:model="social_history.sticks_per_day" class="border rounded p-1 w-20" min="0">
                                <label class="text-md">Packs/year:</label>
                                <input type="number" wire:model="social_history.packs_per_year" class="border rounded p-1 w-20" min="0">
                            </div>
                        </div>

                        <!-- Alcohol Consumption -->
                        <div class="flex flex-col">
                            <label class="font-bold text-lg">Alcohol Consumption</label>
                            <select wire:model="social_history.alcohol" class="border rounded p-1 w-full">
                                <option value="">Select bottles per week</option>
                                <option value="N/A">N/A</option>
                                @for ($i = 1; $i <= 20; $i++)
                                    <option value="{{ $i }}">{{ $i }} bottle(s) per week</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Medications -->
                        <div class="col-span-2 flex flex-col">
                            <label class="text-lg font-bold">Medications</label>
                            <input type="text" wire:model="social_history.medications" class="border rounded-md p-1 w-[23.15rem]">
                        </div>

                        <!-- Loop Through Other Fields (Vape, etc.) -->
                        @foreach ($social_history as $key => $value)
                            @if (!in_array($key, ['Smoker', 'Alcohol', 'Medications', 'sticks_per_day', 'packs_per_year']))
                                <div class="flex flex-col my-2">
                                    <span class="font-bold">{{ $key }}</span>
                                    <div class="flex gap-4 mt-1">
                                        <label class="flex items-center space-x-1">
                                            <input type="radio" wire:model="social_history.{{ $key }}" value="Yes" class="accent-black">
                                            <span>Yes</span>
                                        </label>
                                        <label class="flex items-center space-x-1">
                                            <input type="radio" wire:model="social_history.{{ $key }}" value="No" class="accent-black">
                                            <span>No</span>
                                        </label>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                <div class="mt-6 bg-prims-yellow-1 rounded-lg p-4 mb-4">
                    <h3 class="text-lg font-semibold">Medical Findings</h3>
                </div>
                <label class="font-medium text-lg">Physical Examination</label>
                <textarea wire:model="pe" class="w-full border p-2 rounded mt-2 mb-1" placeholder="Physical Examination"></textarea>

                <label class="block text-lg font-medium">Diagnosis</label>
                <select wire:model="diagnosis" class="w-full p-2 border rounded-md mb-4">
                    <option value="">Select a diagnosis</option>
                    <optgroup label="Cardiology">
                        <option value="Hypertension">Hypertension</option>
                        <option value="BP Monitoring">BP Monitoring</option>
                        <option value="Bradycardia">Bradycardia</option>
                        <option value="Hypotension">Hypotension</option>
                        <option value="Angina">Angina</option>
                    </optgroup>
                    <optgroup label="Pulmonology">
                        <option value="URTI">URTI</option>
                        <option value="Pneumonia">Pneumonia</option>
                        <option value="PTB">PTB</option>
                        <option value="Bronchitis">Bronchitis</option>
                        <option value="Lung Pathology">Lung Pathology</option>
                        <option value="Acute Bronchitis">Acute Bronchitis</option>
                    </optgroup>
                    <optgroup label="Gastroenterology">
                        <option value="Acute Gastroenteritis">Acute Gastroenteritis</option>
                        <option value="GERD">GERD</option>
                        <option value="Hemorrhoids">Hemorrhoids</option>
                        <option value="Anorexia">Anorexia</option>
                    </optgroup>
                    <optgroup label="Musculo Skeletal">
                        <option value="Ligament Sprain">Ligament Sprain</option>
                        <option value="Muscle Strain">Muscle Strain</option>
                        <option value="Costochondritis">Costochondritis</option>
                        <option value="Soft Tissue Contusion">Soft Tissue Contusion</option>
                        <option value="Fracture">Fracture</option>
                        <option value="Gouty Arthritis">Gouty Arthritis</option>
                        <option value="Plantar Fasciitis">Plantar Fasciitis</option>
                        <option value="Dislocation">Dislocation</option>
                    </optgroup>
                    <optgroup label="Ophthalmology">
                        <option value="Conjunctivitis">Conjunctivitis</option>
                        <option value="Stye">Stye</option>
                        <option value="Foreign Body">Foreign Body</option>
                    </optgroup>
                    <optgroup label="ENT">
                        <option value="Stomatitis">Stomatitis</option>
                        <option value="Epistaxis">Epistaxis</option>
                        <option value="Otitis Media">Otitis Media</option>
                        <option value="Foreign Body Removal">Foreign Body Removal</option>
                    </optgroup>
                    <optgroup label="Neurology">
                        <option value="Tension Headache">Tension Headache</option>
                        <option value="Migraine">Migraine</option>
                        <option value="Vertigo">Vertigo</option>
                        <option value="Hyperventilation Syndrome">Hyperventilation Syndrome</option>
                        <option value="Insomnia">Insomnia</option>
                        <option value="Seizure">Seizure</option>
                        <option value="Bell's Palsy">Bell's Palsy</option>
                    </optgroup>
                    <optgroup label="Dermatology">
                        <option value="Folliculitis">Folliculitis</option>
                        <option value="Acne">Acne</option>
                        <option value="Burn">Burn</option>
                        <option value="Wound Dressing">Wound Dressing</option>
                        <option value="Infected Wound">Infected Wound</option>
                        <option value="Blister Wound">Blister Wound</option>
                        <option value="Seborrheic Dermatitis">Seborrheic Dermatitis</option>
                        <option value="Bruise/Hematoma">Bruise/Hematoma</option>
                    </optgroup>
                    <optgroup label="Nephrology">
                        <option value="Urinary Tract Infection">Urinary Tract Infection</option>
                        <option value="Renal Disease">Renal Disease</option>
                        <option value="Urolithiasis">Urolithiasis</option>
                    </optgroup>
                    <optgroup label="Endocrinology">
                        <option value="Hypoglycemia">Hypoglycemia</option>
                        <option value="Dyslipidemia">Dyslipidemia</option>
                        <option value="Diabetes Mellitus">Diabetes Mellitus</option>
                    </optgroup>
                    <optgroup label="OB-Gyne">
                        <option value="Dysmenorrhea">Dysmenorrhea</option>
                        <option value="Hormonal Imbalance">Hormonal Imbalance</option>
                        <option value="Pregnancy">Pregnancy</option>
                    </optgroup>
                    <optgroup label="Hematologic">
                        <option value="Leukemia">Leukemia</option>
                        <option value="Blood Dyscrasia">Blood Dyscrasia</option>
                        <option value="Anemia">Anemia</option>
                    </optgroup>
                    <optgroup label="Surgery">
                        <option value="Lacerated Wound">Lacerated Wound</option>
                        <option value="Punctured Wound">Punctured Wound</option>
                        <option value="Animal Bite">Animal Bite</option>
                        <option value="Superficial Abrasions">Superficial Abrasions</option>
                        <option value="Foreign Body Removal">Foreign Body Removal</option>
                    </optgroup>
                    <optgroup label="Allergology">
                        <option value="Contact Dermatitis">Contact Dermatitis</option>
                        <option value="Allergic Rhinitis">Allergic Rhinitis</option>
                        <option value="Bronchial Asthma">Bronchial Asthma</option>
                        <option value="Hypersensitivity">Hypersensitivity</option>
                    </optgroup>
                    <optgroup label="Psychological">
                        <option value="Post Traumatic Stress">Post Traumatic Stress</option>
                        <option value="Bipolar Disorder">Bipolar Disorder</option>
                        <option value="Clinical Depression">Clinical Depression</option>
                        <option value="Major Depressive Disorder">Major Depressive Disorder</option>
                        <option value="Agoraphobia">Agoraphobia</option>
                        <option value="ADHD">ADHD</option>
                        <option value="Anxiety Disorder">Anxiety Disorder</option>
                    </optgroup>
                </select>

                <label class="font-medium text-lg mt-4">Prescription</label>
                <textarea wire:model="prescription" class="w-full border p-2 rounded mb-1" placeholder="Prescription"></textarea>

            </div>

            <div class="mt-6 flex justify-end">
                <a href="/staff/medical-records" class="text-prims-azure-500 text-md m-2 mx-6 underline hover:text-prims-yellow-1 transition ease-in-out duration-150"> Back </a>
                <button 
                id="addRecordButton" 
                class="px-4 py-2 bg-prims-azure-500 text-white rounded-lg hover:bg-prims-azure-100"
                wire:click="submit"
            >
                {{ $fromStaffCalendar ? 'Complete Appointment' : 'Submit' }}
                </button>
        </form>
    </div>
</div>