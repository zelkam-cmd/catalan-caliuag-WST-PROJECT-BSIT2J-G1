import React, { useState, useEffect } from "react";
import { motion, AnimatePresence } from "motion/react";
import { 
  Plus, 
  Users, 
  Home as HomeIcon, 
  Trash2, 
  Edit3, 
  Calendar, 
  User, 
  Phone, 
  Stethoscope,
  ChevronRight,
  Search,
  X,
  CheckCircle2
} from "lucide-react";

interface Patient {
  "@_id": string;
  name: string;
  age: number;
  gender: string;
  contact: string;
  appointment: string;
  treatment: string;
}

type View = "home" | "add" | "view" | "edit";

export default function App() {
  const [view, setView] = useState<View>("home");
  const [patients, setPatients] = useState<Patient[]>([]);
  const [loading, setLoading] = useState(false);
  const [editingPatient, setEditingPatient] = useState<Patient | null>(null);
  const [searchTerm, setSearchTerm] = useState("");
  const [notification, setNotification] = useState<{message: string, type: 'success' | 'error'} | null>(null);

  useEffect(() => {
    fetchPatients();
  }, []);

  const fetchPatients = async () => {
    setLoading(true);
    try {
      const response = await fetch("/api/patients");
      const data = await response.json();
      setPatients(data);
    } catch (error) {
      console.error("Error fetching patients:", error);
      showNotification("Failed to load patients", "error");
    } finally {
      setLoading(false);
    }
  };

  const showNotification = (message: string, type: 'success' | 'error' = 'success') => {
    setNotification({ message, type });
    setTimeout(() => setNotification(null), 3000);
  };

  const handleAddPatient = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    const formData = new FormData(e.currentTarget);
    const patientData = {
      name: formData.get("name"),
      age: formData.get("age"),
      gender: formData.get("gender"),
      contact: formData.get("contact"),
      appointment: formData.get("appointment"),
      treatment: formData.get("treatment"),
    };

    try {
      const response = await fetch("/api/patients", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(patientData),
      });
      if (response.ok) {
        showNotification("Patient added successfully!");
        fetchPatients();
        setView("view");
      }
    } catch (error) {
      showNotification("Error adding patient", "error");
    }
  };

  const handleUpdatePatient = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    if (!editingPatient) return;

    const formData = new FormData(e.currentTarget);
    const patientData = {
      name: formData.get("name"),
      age: formData.get("age"),
      gender: formData.get("gender"),
      contact: formData.get("contact"),
      appointment: formData.get("appointment"),
      treatment: formData.get("treatment"),
    };

    try {
      const response = await fetch(`/api/patients/${editingPatient["@_id"]}`, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(patientData),
      });
      if (response.ok) {
        showNotification("Patient updated successfully!");
        fetchPatients();
        setView("view");
        setEditingPatient(null);
      }
    } catch (error) {
      showNotification("Error updating patient", "error");
    }
  };

  const handleDeletePatient = async (id: string) => {
    if (!confirm("Are you sure you want to delete this patient?")) return;

    try {
      const response = await fetch(`/api/patients/${id}`, {
        method: "DELETE",
      });
      if (response.ok) {
        showNotification("Patient deleted successfully!");
        fetchPatients();
      }
    } catch (error) {
      showNotification("Error deleting patient", "error");
    }
  };

  const filteredPatients = patients.filter(p => 
    p.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
    p.treatment.toLowerCase().includes(searchTerm.toLowerCase())
  );

  return (
    <div className="min-h-screen flex flex-col">
      {/* Navigation */}
      <nav className="bg-white border-b border-dental-100 sticky top-0 z-50">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between h-20">
            <div className="flex items-center gap-3">
              <div className="w-10 h-10 bg-dental-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-dental-200">
                <Stethoscope size={24} />
              </div>
              <div>
                <h1 className="text-xl font-display font-bold text-dental-900 tracking-tight">BrightSmile</h1>
                <p className="text-[10px] uppercase tracking-widest text-dental-500 font-semibold">Dental Clinic</p>
              </div>
            </div>
            
            <div className="hidden md:flex items-center space-x-1">
              {[
                { id: "home", label: "Home", icon: HomeIcon },
                { id: "add", label: "Add Patient", icon: Plus },
                { id: "view", label: "View Patients", icon: Users },
              ].map((item) => (
                <button
                  key={item.id}
                  onClick={() => setView(item.id as View)}
                  className={`flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 ${
                    view === item.id 
                      ? "bg-dental-50 text-dental-700" 
                      : "text-slate-500 hover:text-dental-600 hover:bg-dental-50/50"
                  }`}
                >
                  <item.icon size={18} />
                  {item.label}
                </button>
              ))}
            </div>

            {/* Mobile Menu Button (simplified) */}
            <div className="md:hidden flex items-center">
              <button className="p-2 text-slate-500">
                <ChevronRight size={24} />
              </button>
            </div>
          </div>
        </div>
      </nav>

      {/* Notification */}
      <AnimatePresence>
        {notification && (
          <motion.div
            initial={{ opacity: 0, y: -20 }}
            animate={{ opacity: 1, y: 0 }}
            exit={{ opacity: 0, y: -20 }}
            className={`fixed top-24 right-8 z-50 px-6 py-3 rounded-2xl shadow-xl flex items-center gap-3 ${
              notification.type === 'success' ? 'bg-emerald-500 text-white' : 'bg-rose-500 text-white'
            }`}
          >
            <CheckCircle2 size={20} />
            <span className="font-medium">{notification.message}</span>
          </motion.div>
        )}
      </AnimatePresence>

      {/* Main Content */}
      <main className="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-12">
        <AnimatePresence mode="wait">
          {view === "home" && (
            <motion.div
              key="home"
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              exit={{ opacity: 0, y: -20 }}
              className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center"
            >
              <div className="space-y-8">
                <div className="space-y-4">
                  <span className="inline-block px-4 py-1.5 bg-dental-100 text-dental-700 rounded-full text-xs font-bold uppercase tracking-wider">
                    Welcome to BrightSmile
                  </span>
                  <h2 className="text-5xl md:text-6xl font-display font-bold text-slate-900 leading-[1.1] tracking-tight">
                    Modern Dental Care for <span className="text-dental-600">Your Family</span>
                  </h2>
                  <p className="text-lg text-slate-600 max-w-lg leading-relaxed">
                    Manage your patients with ease using our advanced XML-powered clinic management system. Fast, secure, and reliable.
                  </p>
                </div>
                
                <div className="flex flex-wrap gap-4">
                  <button 
                    onClick={() => setView("add")}
                    className="px-8 py-4 bg-dental-600 text-white rounded-2xl font-bold shadow-lg shadow-dental-200 hover:bg-dental-700 hover:-translate-y-1 transition-all duration-300 flex items-center gap-3"
                  >
                    <Plus size={20} />
                    Register New Patient
                  </button>
                  <button 
                    onClick={() => setView("view")}
                    className="px-8 py-4 bg-white text-dental-700 border-2 border-dental-100 rounded-2xl font-bold hover:bg-dental-50 transition-all duration-300 flex items-center gap-3"
                  >
                    <Users size={20} />
                    Manage Database
                  </button>
                </div>

                <div className="grid grid-cols-3 gap-8 pt-8 border-t border-dental-100">
                  {[
                    { label: "Patients", value: patients.length },
                    { label: "Treatments", value: "12+" },
                    { label: "Rating", value: "4.9/5" },
                  ].map((stat, i) => (
                    <div key={i}>
                      <p className="text-3xl font-display font-bold text-slate-900">{stat.value}</p>
                      <p className="text-sm text-slate-500 font-medium">{stat.label}</p>
                    </div>
                  ))}
                </div>
              </div>

              <div className="relative">
                <div className="absolute -inset-4 bg-dental-200/30 blur-3xl rounded-full"></div>
                <img 
                  src="https://picsum.photos/seed/dentist/800/800" 
                  alt="Dental Clinic" 
                  className="relative rounded-[2.5rem] shadow-2xl object-cover aspect-square"
                  referrerPolicy="no-referrer"
                />
                <div className="absolute -bottom-6 -left-6 bg-white p-6 rounded-3xl shadow-xl border border-dental-100 max-w-[240px]">
                  <div className="flex items-center gap-4 mb-4">
                    <div className="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600">
                      <Calendar size={24} />
                    </div>
                    <div>
                      <p className="text-xs text-slate-500 font-bold uppercase tracking-wider">Next Appointment</p>
                      <p className="font-bold text-slate-900">Today, 2:30 PM</p>
                    </div>
                  </div>
                  <div className="flex -space-x-2">
                    {[1, 2, 3, 4].map(i => (
                      <img key={i} src={`https://i.pravatar.cc/100?u=${i}`} className="w-8 h-8 rounded-full border-2 border-white" alt="Patient" />
                    ))}
                    <div className="w-8 h-8 rounded-full bg-dental-100 border-2 border-white flex items-center justify-center text-[10px] font-bold text-dental-600">+12</div>
                  </div>
                </div>
              </div>
            </motion.div>
          )}

          {(view === "add" || view === "edit") && (
            <motion.div
              key="form"
              initial={{ opacity: 0, scale: 0.95 }}
              animate={{ opacity: 1, scale: 1 }}
              exit={{ opacity: 0, scale: 0.95 }}
              className="max-w-2xl mx-auto"
            >
              <div className="bg-white rounded-[2rem] shadow-xl border border-dental-100 overflow-hidden">
                <div className="bg-dental-600 p-8 text-white">
                  <h3 className="text-2xl font-display font-bold">
                    {view === "add" ? "Register New Patient" : "Edit Patient Profile"}
                  </h3>
                  <p className="text-dental-100 mt-1 opacity-80">
                    Please fill in the patient information accurately.
                  </p>
                </div>
                
                <form 
                  onSubmit={view === "add" ? handleAddPatient : handleUpdatePatient}
                  className="p-8 space-y-6"
                >
                  <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div className="space-y-2">
                      <label className="text-sm font-bold text-slate-700 flex items-center gap-2">
                        <User size={16} className="text-dental-500" />
                        Full Name
                      </label>
                      <input 
                        name="name"
                        required
                        defaultValue={editingPatient?.name}
                        placeholder="e.g. John Doe"
                        className="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-dental-500 focus:border-transparent outline-none transition-all"
                      />
                    </div>
                    <div className="space-y-2">
                      <label className="text-sm font-bold text-slate-700 flex items-center gap-2">
                        <Calendar size={16} className="text-dental-500" />
                        Age
                      </label>
                      <input 
                        name="age"
                        type="number"
                        required
                        defaultValue={editingPatient?.age}
                        placeholder="e.g. 25"
                        className="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-dental-500 focus:border-transparent outline-none transition-all"
                      />
                    </div>
                    <div className="space-y-2">
                      <label className="text-sm font-bold text-slate-700">Gender</label>
                      <select 
                        name="gender"
                        required
                        defaultValue={editingPatient?.gender || "Male"}
                        className="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-dental-500 focus:border-transparent outline-none transition-all"
                      >
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                      </select>
                    </div>
                    <div className="space-y-2">
                      <label className="text-sm font-bold text-slate-700 flex items-center gap-2">
                        <Phone size={16} className="text-dental-500" />
                        Contact Number
                      </label>
                      <input 
                        name="contact"
                        required
                        defaultValue={editingPatient?.contact}
                        placeholder="09XXXXXXXXX"
                        className="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-dental-500 focus:border-transparent outline-none transition-all"
                      />
                    </div>
                    <div className="space-y-2">
                      <label className="text-sm font-bold text-slate-700">Appointment Date</label>
                      <input 
                        name="appointment"
                        type="date"
                        required
                        defaultValue={editingPatient?.appointment}
                        className="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-dental-500 focus:border-transparent outline-none transition-all"
                      />
                    </div>
                    <div className="space-y-2">
                      <label className="text-sm font-bold text-slate-700 flex items-center gap-2">
                        <Stethoscope size={16} className="text-dental-500" />
                        Treatment
                      </label>
                      <input 
                        name="treatment"
                        required
                        defaultValue={editingPatient?.treatment}
                        placeholder="e.g. Cleaning"
                        className="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-dental-500 focus:border-transparent outline-none transition-all"
                      />
                    </div>
                  </div>

                  <div className="pt-4 flex gap-4">
                    <button 
                      type="submit"
                      className="flex-grow py-4 bg-dental-600 text-white rounded-2xl font-bold shadow-lg shadow-dental-200 hover:bg-dental-700 transition-all"
                    >
                      {view === "add" ? "Register Patient" : "Update Profile"}
                    </button>
                    <button 
                      type="button"
                      onClick={() => setView("view")}
                      className="px-8 py-4 bg-slate-100 text-slate-600 rounded-2xl font-bold hover:bg-slate-200 transition-all"
                    >
                      Cancel
                    </button>
                  </div>
                </form>
              </div>
            </motion.div>
          )}

          {view === "view" && (
            <motion.div
              key="view"
              initial={{ opacity: 0 }}
              animate={{ opacity: 1 }}
              exit={{ opacity: 0 }}
              className="space-y-8"
            >
              <div className="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                  <h2 className="text-3xl font-display font-bold text-slate-900 tracking-tight">Patient Database</h2>
                  <p className="text-slate-500 font-medium">Manage and monitor all registered patients.</p>
                </div>
                
                <div className="relative max-w-md w-full">
                  <Search className="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400" size={20} />
                  <input 
                    type="text"
                    placeholder="Search by name or treatment..."
                    value={searchTerm}
                    onChange={(e) => setSearchTerm(e.target.value)}
                    className="w-full pl-12 pr-4 py-3 bg-white border border-dental-100 rounded-2xl shadow-sm focus:ring-2 focus:ring-dental-500 focus:border-transparent outline-none transition-all"
                  />
                  {searchTerm && (
                    <button 
                      onClick={() => setSearchTerm("")}
                      className="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600"
                    >
                      <X size={16} />
                    </button>
                  )}
                </div>
              </div>

              <div className="bg-white rounded-[2rem] shadow-xl border border-dental-100 overflow-hidden">
                <div className="overflow-x-auto">
                  <table className="w-full text-left border-collapse">
                    <thead>
                      <tr className="bg-dental-50/50 border-b border-dental-100">
                        <th className="px-8 py-5 text-xs font-bold uppercase tracking-wider text-dental-700">Patient</th>
                        <th className="px-8 py-5 text-xs font-bold uppercase tracking-wider text-dental-700">Details</th>
                        <th className="px-8 py-5 text-xs font-bold uppercase tracking-wider text-dental-700">Appointment</th>
                        <th className="px-8 py-5 text-xs font-bold uppercase tracking-wider text-dental-700">Treatment</th>
                        <th className="px-8 py-5 text-xs font-bold uppercase tracking-wider text-dental-700 text-right">Actions</th>
                      </tr>
                    </thead>
                    <tbody className="divide-y divide-dental-50">
                      {loading ? (
                        <tr>
                          <td colSpan={5} className="px-8 py-12 text-center text-slate-400 font-medium">
                            <div className="flex items-center justify-center gap-3">
                              <div className="w-5 h-5 border-2 border-dental-500 border-t-transparent rounded-full animate-spin"></div>
                              Loading patient records...
                            </div>
                          </td>
                        </tr>
                      ) : filteredPatients.length === 0 ? (
                        <tr>
                          <td colSpan={5} className="px-8 py-12 text-center text-slate-400 font-medium">
                            No patients found matching your criteria.
                          </td>
                        </tr>
                      ) : (
                        filteredPatients.map((patient) => (
                          <tr key={patient["@_id"]} className="hover:bg-dental-50/30 transition-colors group">
                            <td className="px-8 py-6">
                              <div className="flex items-center gap-4">
                                <div className="w-12 h-12 bg-dental-100 rounded-2xl flex items-center justify-center text-dental-600 font-bold text-lg">
                                  {patient.name.charAt(0)}
                                </div>
                                <div>
                                  <p className="font-bold text-slate-900">{patient.name}</p>
                                  <p className="text-xs text-slate-500 font-medium">ID: {patient["@_id"].slice(-6)}</p>
                                </div>
                              </div>
                            </td>
                            <td className="px-8 py-6">
                              <div className="space-y-1">
                                <p className="text-sm text-slate-700"><span className="font-bold">Age:</span> {patient.age}</p>
                                <p className="text-sm text-slate-700"><span className="font-bold">Gender:</span> {patient.gender}</p>
                              </div>
                            </td>
                            <td className="px-8 py-6">
                              <div className="space-y-1">
                                <p className="text-sm font-bold text-slate-900">{patient.appointment}</p>
                                <p className="text-xs text-slate-500 font-medium flex items-center gap-1">
                                  <Phone size={12} />
                                  {patient.contact}
                                </p>
                              </div>
                            </td>
                            <td className="px-8 py-6">
                              <span className="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold">
                                {patient.treatment}
                              </span>
                            </td>
                            <td className="px-8 py-6">
                              <div className="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button 
                                  onClick={() => {
                                    setEditingPatient(patient);
                                    setView("edit");
                                  }}
                                  className="p-2 text-dental-600 hover:bg-dental-100 rounded-xl transition-colors"
                                  title="Edit Profile"
                                >
                                  <Edit3 size={18} />
                                </button>
                                <button 
                                  onClick={() => handleDeletePatient(patient["@_id"])}
                                  className="p-2 text-rose-500 hover:bg-rose-50 rounded-xl transition-colors"
                                  title="Delete Record"
                                >
                                  <Trash2 size={18} />
                                </button>
                              </div>
                            </td>
                          </tr>
                        ))
                      )}
                    </tbody>
                  </table>
                </div>
              </div>
            </motion.div>
          )}
        </AnimatePresence>
      </main>

      {/* Footer */}
      <footer className="bg-white border-t border-dental-100 py-12">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex flex-col md:flex-row justify-between items-center gap-8">
            <div className="flex items-center gap-3">
              <div className="w-8 h-8 bg-dental-600 rounded-lg flex items-center justify-center text-white">
                <Stethoscope size={18} />
              </div>
              <h1 className="text-lg font-display font-bold text-dental-900">BrightSmile</h1>
            </div>
            
            <div className="flex gap-8 text-sm font-medium text-slate-500">
              <a href="#" className="hover:text-dental-600 transition-colors">Privacy Policy</a>
              <a href="#" className="hover:text-dental-600 transition-colors">Terms of Service</a>
              <a href="#" className="hover:text-dental-600 transition-colors">Contact Support</a>
            </div>

            <p className="text-sm text-slate-400 font-medium">
              &copy; 2026 BrightSmile Dental Clinic. All rights reserved.
            </p>
          </div>
        </div>
      </footer>
    </div>
  );
}

