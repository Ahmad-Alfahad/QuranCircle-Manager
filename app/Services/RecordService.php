<?php
 namespace App\Services;
 use App\Models\Record;
 class RecordService {

        public function getRecentRecords($limit = 10)
        {
            return Record::with(['circleStudent.student', 'surah'])
                ->latest()
                ->take($limit)
                ->get();
        }

        public function list($user , array $filter = []) {
            $query = Record::query()->with(['circleStudent.student' , 'circleStudent.circle' , 'surah']) ;
            $this->applyAuthorization($query , $user) ;
            $this->applyFilters($query , $filter) ;
            return $query->latest()->paginate(10) ;
        }   

        private function applyAuthorization($query , $user):void {
            if($user->role === 'admin') {
                return ;
            } elseif($user->role === 'teacher') {
                $query->whereHas('circleStudent.circle' , function($q) use ($user) {
                    $q->where('teacher_id' , $user->id) ;
                }) ;
            } elseif($user->role === 'student') {
                $query->whereHas('circleStudent.student' , function($q) use ($user) {
                    $q->where('student_id' , $user->id) ;
                }) ;
            } else {
                abort(403) ;
            }
        }

        private function applyFilters($query , array $filter):void {
            if(isset($filter['circle_id'])) {
                $query->whereHas('circleStudent.circle' , function($q) use ($filter) {
                    $q->where('id' , $filter['circle_id']) ;
                }) ;
            }
            if(isset($filter['student_id'])) {
                $query->whereHas('circleStudent.student' , function($q) use ($filter) {
                    $q->where('student_id' , $filter['student_id']) ;
                }) ;
            }
            if(isset($filter['surah_id'])) {
                $query->where('surah_id' , $filter['surah_id']) ;
            }
        }
 }