import '../api/api_client.dart';
import '../models/models.dart';

class JobsRepository {
  const JobsRepository(this._apiClient);

  final JobsApiClient _apiClient;

  Future<List<Job>> fetchJobs({String? query}) async {
    final payload = await _apiClient.getJson('/api/jobs', query: {
      if (query != null) 'search': query,
    });
    final list = payload['data'] as List<dynamic>? ?? [];
    return list.map((job) => Job.fromJson(job as Map<String, dynamic>)).toList();
  }

  Future<Job> fetchJob(int id) async {
    final payload = await _apiClient.getJson('/api/jobs/$id');
    return Job.fromJson(payload['data'] as Map<String, dynamic>);
  }

  Future<JobApplication> apply({
    required int jobId,
    required CandidateProfile candidate,
    List<ScreeningAnswer> answers = const <ScreeningAnswer>[],
    CvDocument? cv,
    CoverLetter? coverLetter,
  }) async {
    final payload = await _apiClient.postJson('/api/jobs/$jobId/applications',
        body: {
          'candidate': candidate.toJson(),
          'answers': answers.map((answer) => answer.toJson()).toList(),
          'cv': cv?.toJson(),
          'cover_letter': coverLetter?.toJson(),
        });
    return JobApplication.fromJson(payload['data'] as Map<String, dynamic>);
  }

  Future<List<JobApplication>> fetchApplications({int? companyId}) async {
    final payload = await _apiClient.getJson('/api/applications', query: {
      if (companyId != null) 'company_id': '$companyId',
    });
    final list = payload['data'] as List<dynamic>? ?? [];
    return list
        .map((app) => JobApplication.fromJson(app as Map<String, dynamic>))
        .toList();
  }

  Future<JobApplication> moveToStage({
    required int applicationId,
    required int stageId,
  }) async {
    final payload = await _apiClient.postJson(
      '/api/applications/$applicationId/stage',
      body: {'stage_id': stageId},
    );
    return JobApplication.fromJson(payload['data'] as Map<String, dynamic>);
  }

  Future<AtsPipeline> fetchPipeline(int jobId) async {
    final payload = await _apiClient.getJson('/api/jobs/$jobId/pipeline');
    return AtsPipeline.fromJson(payload['data'] as Map<String, dynamic>);
  }

  Future<InterviewSchedule> scheduleInterview({
    required int applicationId,
    required DateTime start,
    required DateTime end,
    String? location,
    String? link,
  }) async {
    final payload = await _apiClient.postJson(
      '/api/applications/$applicationId/interviews',
      body: {
        'start': start.toIso8601String(),
        'end': end.toIso8601String(),
        'location': location,
        'link': link,
      },
    );
    return InterviewSchedule.fromJson(payload['data'] as Map<String, dynamic>);
  }
}
