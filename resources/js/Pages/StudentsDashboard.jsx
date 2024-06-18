import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import AddStudentButton from "@/Components/AddStudentButton";
import ModalUpdate from "@/Components/ModalUpdate";
import ModalDelete from "@/Components/ModalDelete";

export default function StudentsDashboard({ auth, studentsData, count }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Students Dashboard
                </h2>
            }
        >
            <Head title="Students Dashboard" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <span>
                                Total Students:{" "}
                                {count == 0 ? "No students yet" : count}
                            </span>
                            <AddStudentButton className="float-end" />
                        </div>
                        <table className="table">
                            {/* head */}
                            <thead className="text-black">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {studentsData.map((s) => (
                                    <tr
                                        className="text-black hover:bg-slate-300"
                                        key={s.student_id}
                                    >
                                        <td>{s.student_id}</td>
                                        <td>
                                            <div className="flex items-center gap-3">
                                                <div>
                                                    <div className="font-bold">
                                                        {s.first_name}
                                                        &nbsp;
                                                        {s.last_name}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{s.department}</td>
                                        <td>{s.email}</td>
                                        <th className="flex gap-3">
                                            {/* Modal */}
                                            <ModalUpdate
                                                id={`my_modal_3${s.student_id}`}
                                                s={s}
                                            />
                                            <ModalDelete
                                                id={`my_modal_4${s.student_id}`}
                                                s={s}
                                            />
                                        </th>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
